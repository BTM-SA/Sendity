<?php

use Sendity\Controllers\HomeController;
use Sendity\Http\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

$router->get('/', [HomeController::class, 'index']);

$router->get('/health', [HomeController::class, 'health']);

$router->get('/api/status', function () {
    return Response::json([
        'status' => 'ok',
        'app' => 'Sendity'
    ]);
});
$router->get('/send-test', [HomeController::class, 'sendTest']);

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

$router->get('/imap-test', function () use ($container) {

    $mailbox = $container->get(
        \Sendity\Mail\Contracts\MailboxInterface::class
    );

    $mailbox->connect();

    $mailbox->disconnect();

    return 'IMAP connection successful';
});
$router->get('/imap-folders', function () use ($container) {

    $mailbox = $container->get(
        \Sendity\Mail\Contracts\MailboxInterface::class
    );

    $folders = $mailbox->folders();

    return implode('<br>', $folders);
});

$router->get('/mailbox-driver-test', function () use ($container) {

    $mailbox = $container->get(
        \Sendity\Mail\Contracts\MailboxInterface::class
    );

    return get_class($mailbox);

});

$router->get('/boom', function () {
    throw new RuntimeException('Boom!');
});