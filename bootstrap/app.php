<?php

use Sendity\Controllers\HomeController;
use Sendity\Core\Application;
use Sendity\Core\Container;
use Sendity\Http\Response;
use Sendity\Services\Logger;

require_once __DIR__ . '/../vendor/autoload.php';

// Container
$container = new Container();

// services
$container->bind(Logger::class, fn () => new Logger());

// IMPORTANT: singleton router
$container->singleton(
    \Sendity\Http\Router::class,
    fn ($c) => new \Sendity\Http\Router($c)
);

// get shared router instance
$router = $container->get(\Sendity\Http\Router::class);

// register routes on shared instance
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

// run app
return $container->get(Application::class);