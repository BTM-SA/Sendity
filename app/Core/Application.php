<?php

namespace Sendity\Core;

use Sendity\Http\Request;
use Sendity\Http\Router;
use Sendity\Http\Middleware\LoggerMiddleware;

class Application
{
    public function __construct(
        protected Container $container,
        protected Request $request,
        protected Router $router
    ) {}

    public function run(): void
    {
        $middleware = $this->container->get(LoggerMiddleware::class);

        // ensure consistent format (always array)
        $middlewareStack = is_array($middleware) ? $middleware : [$middleware];

        foreach ($middlewareStack as $mw) {
            $mw->handle($this->request);
        }

        $this->router->dispatch($this->request);
    }
}