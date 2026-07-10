<?php

namespace Sendity\Providers;

use Sendity\Core\Providers\ServiceProvider;
use Sendity\Http\Router;

class RoutingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(
            Router::class,
            fn ($container) => new Router($container)
        );
    }

    public function boot(): void
{
    $router = $this->container->get(Router::class);
    $container = $this->container;

    require __DIR__ . '/../../routes/web.php';
}
}