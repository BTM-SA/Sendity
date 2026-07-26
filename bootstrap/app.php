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
use Dotenv\Dotenv;
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();


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

$providers = require __DIR__ . '/../config/providers.php';

$providerLoader->load($providers);
// Run application
return $container->get(Application::class);