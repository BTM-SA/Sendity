<?php

namespace Sendity\Core;

use Sendity\Core\Exceptions\ExceptionHandler;
use Sendity\Http\Middleware\LoggerMiddleware;
use Sendity\Http\Request;
use Sendity\Http\Router;
use Throwable;

class Application
{
    public function __construct(
        protected Container $container,
        protected Request $request,
        protected Router $router,
        protected Pipeline $pipeline
    ) {}

    public function run(): void
    {
        try {

            $middleware = [
                $this->container->get(LoggerMiddleware::class),
            ];

            $this->pipeline
                ->send($this->request)
                ->through($middleware)
                ->then(function ($request) {
                    $this->router->dispatch($request);
                });

        } catch (Throwable $e) {

            $handler = $this->container->get(ExceptionHandler::class);

            $reference = $handler->report($e);

            $handler->render($e, $reference);
        }
    }
}