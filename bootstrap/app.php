<?php

use Sendity\Core\Application;
use Sendity\Core\Config;
use Sendity\Core\Container;
use Sendity\Services\Logger;
use Sendity\Core\Exceptions\ExceptionHandler;
use Sendity\Core\Events\EventDispatcher;
use Sendity\Core\Providers\ProviderLoader;
use Sendity\Providers\AppServiceProvider;
use Sendity\Providers\RoutingServiceProvider;
require_once __DIR__ . '/../vendor/autoload.php';

// Container
$container = new Container();

// Configuration
$container->singleton(
    ProviderLoader::class,
    fn ($container) => new ProviderLoader($container)
);

// Services

// Router singleton

$providerLoader = $container->get(
    ProviderLoader::class
);

$providerLoader->load([
    AppServiceProvider::class,
    RoutingServiceProvider::class,
]);
// Run application
return $container->get(Application::class);