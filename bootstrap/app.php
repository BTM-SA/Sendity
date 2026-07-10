<?php

use Sendity\Core\Application;
use Sendity\Core\Config;
use Sendity\Core\Container;
use Sendity\Controllers\HomeController;
use Sendity\Services\Logger;
use Sendity\Core\Exceptions\ExceptionHandler;
use Sendity\Http\Response;
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
$router->get('/event-test', function () use ($container) {

    $events = $container->get(
        \Sendity\Core\Events\EventDispatcher::class
    );

    $events->listen(
        \Sendity\Events\MailSent::class,
        \Sendity\Listeners\LogMailSent::class
    );

    $events->dispatch(
        new \Sendity\Events\MailSent(
            'cedric@example.com',
            'Hello Sendity!'
        )
    );

    return 'Event dispatched!';
});
$router->get('/boom', function () {
    throw new RuntimeException('Boom!');
});

// Run application
return $container->get(Application::class);