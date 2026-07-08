<?php

use Sendity\Core\Application;
use Sendity\Core\Config;
use Sendity\Core\Container;
use Sendity\Controllers\HomeController;
use Sendity\Services\Logger;
use Sendity\Core\Exceptions\ExceptionHandler;
use Sendity\Http\Response;

require_once __DIR__ . '/../vendor/autoload.php';

// Container
$container = new Container();

// Configuration
$container->singleton(
    Config::class,
    function () {
        $config = new Config();

        $config->load(
            __DIR__ . '/../config/app.php'
        );

        $config->load(
            __DIR__ . '/../config/mail.php'
        );

        return $config;
    }
);

// Services
$container->bind(Logger::class, fn () => new Logger());

$container->singleton(
    ExceptionHandler::class,
    fn () => new ExceptionHandler()
);
// Router singleton
$container->singleton(
    \Sendity\Http\Router::class,
    fn ($c) => new \Sendity\Http\Router($c)
);

// Shared router instance
$router = $container->get(\Sendity\Http\Router::class);

// Routes
$router->get('/', [HomeController::class, 'index']);

$router->get('/health', [HomeController::class, 'health']);

$router->get('/api/status', function () {
    return Response::json([
        'status' => 'ok',
        'app' => 'Sendity'
    ]);
});

$router->get('/user/{id}', function ($id) {
    return "User ID: {$id}";
});


// Run application
return $container->get(Application::class);