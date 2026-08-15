<?php

namespace Sendity\Providers;

use Sendity\Core\Providers\ServiceProvider;
use Sendity\Services\Logger;
use Sendity\Core\Config;
use Sendity\Core\Exceptions\ExceptionHandler;
use Sendity\Core\Events\EventDispatcher;
use Sendity\Routing\RouteLoader;
use Sendity\Mail\SendEmail;
use Sendity\Mail\MailManager;
use Sendity\Mail\MessageIdGenerator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(Config::class, function () {
            $config = new Config();

            $config->load("app", __DIR__ . "/../../config/app.php");

            $config->load("mail", __DIR__ . "/../../config/mail.php");
            $config->load("audit", __DIR__ . "/../../config/audit.php");

            return $config;
        });

        $this->container->bind(Logger::class, fn() => new Logger());

        $this->container->singleton(ExceptionHandler::class, fn() => new ExceptionHandler());

        $this->container->singleton(
    EventDispatcher::class,
    fn($container) => new EventDispatcher(
        $container,
        $container->get(Logger::class)
    )
);
        $this->container->singleton(RouteLoader::class, function ($container) {
            return new RouteLoader($container->get(\Sendity\Http\Router::class), $container);
        });
        $this->container->singleton(
    SendEmail::class,
    function ($container) {
        return new SendEmail(
            $container->get(MailManager::class),
            $container->get(MessageIdGenerator::class)
        );
    }
);
    }

    public function boot(): void
    {
        //
    }
}
