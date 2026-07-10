<?php

namespace Sendity\Routing;

use Sendity\Core\Container;
use Sendity\Http\Router;

class RouteLoader
{
    public function __construct(
        protected Router $router,
        protected Container $container
    ) {
    }

    public function loadWebRoutes(): void
    {
        $router = $this->router;
        $container = $this->container;

        require __DIR__ . '/../../routes/web.php';
    }
}