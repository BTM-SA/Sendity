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
        protected Router $router,
        protected Pipeline $pipeline
    ) {}

    public function run(): void
    {
        $middleware = [
            $this->container->get(LoggerMiddleware::class),
        ];

        $this->pipeline
            ->send($this->request)
            ->through($middleware)
            ->then(function ($request) {
                $this->router->dispatch($request);
            });
    }
}