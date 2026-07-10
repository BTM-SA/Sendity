<?php

namespace Sendity\Providers;


use Sendity\Core\Providers\ServiceProvider;
use Sendity\Services\Logger;
use Sendity\Core\Config;
use Sendity\Core\Exceptions\ExceptionHandler;
use Sendity\Core\Events\EventDispatcher;
use Sendity\Routing\RouteLoader;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
{
    $this->container->singleton(
        Config::class,
        function () {
            $config = new Config();

            $config->load(
                __DIR__ . '/../../config/app.php'
            );

            $config->load(
                __DIR__ . '/../../config/mail.php'
            );

            return $config;
        }
    );

    $this->container->bind(
        Logger::class,
        fn () => new Logger()
    );

    $this->container->singleton(
        ExceptionHandler::class,
        fn () => new ExceptionHandler()
    );
        $this->container->singleton(
    EventDispatcher::class,
    fn ($container) => new EventDispatcher($container)
);
        $this->container->singleton(
    RouteLoader::class,
    fn ($container) => new RouteLoader(
        $container->get(\Sendity\Http\Router::class),
        $container
    )
);
}

    public function boot(): void
    {
        //
    }
}