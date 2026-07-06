<?php

namespace Sendity\Http;

use Sendity\Core\Container;
use Sendity\Http\Request;
use Sendity\Http\Response;

class Router
{
    protected array $routes = [];

    public function __construct(
        protected Container $container
    ) {}

    public function get(string $path, callable|array $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable|array $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    protected function addRoute(string $method, string $path, callable|array $handler): void
    {
        $this->routes[$method][] = [
            'path' => $path,
            'handler' => $handler,
            'regex' => $this->convertPathToRegex($path),
            'parameters' => $this->extractParameterNames($path),
        ];
    }

    protected function convertPathToRegex(string $path): string
    {
        return "#^" . preg_replace('#\{([\w]+)\}#', '([^/]+)', $path) . "$#";
    }

    protected function extractParameterNames(string $path): array
    {
        preg_match_all('#\{([\w]+)\}#', $path, $matches);
        return $matches[1];
    }

    public function dispatch(Request $request): void
    {
        $method = $request->method();
        $path = $request->path();

        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route) {

            if (preg_match($route['regex'], $path, $matches)) {

                array_shift($matches);

                $result = $this->executeWithParams(
                    $route['handler'],
                    $route['parameters'],
                    $matches
                );

                if ($result instanceof Response) {
                    $result->send();
                    return;
                }

                echo $result;
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    protected function executeWithParams(callable|array $handler, array $params, array $values)
    {
        $args = array_combine($params, $values) ?: [];

        // Controller action: [Class, method]
        if (is_array($handler)) {
            [$class, $method] = $handler;

            $controller = $this->container->get($class);

            return $controller->$method(...array_values($args));
        }

        // Closure route
        return $handler(...array_values($args));
    }
}