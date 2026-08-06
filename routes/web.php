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

    echo '<pre>';
    var_dump($folders);
    echo '</pre>';

    exit;

});


$router->get('/mailbox-driver-test', function () use ($container) {

    $mailbox = $container->get(
        \Sendity\Mail\Contracts\MailboxInterface::class
    );

    echo '<pre>';

    echo "Driver: ";
    echo $mailbox->driverName();

    echo PHP_EOL . PHP_EOL;

    echo "Connecting..." . PHP_EOL;

    $mailbox->connect();

    echo "Connected OK" . PHP_EOL . PHP_EOL;


    echo "Folders:" . PHP_EOL;

    print_r(
        $mailbox->folders()
    );


    echo PHP_EOL . "Special folders:" . PHP_EOL;

    if (method_exists($mailbox, 'specialFolders')) {

        print_r(
            $mailbox->specialFolders()
        );

    } else {

        echo "specialFolders() not available";

    }


    echo '</pre>';

    $mailbox->disconnect();

});


$router->get('/imap-function-test', function () {

    return function_exists('imap_open')
        ? 'imap_open exists'
        : 'imap_open missing';

});


$router->get('/imap-mailboxes', function () use ($container) {

    $mailbox = $container->get(
        \Sendity\Mail\Contracts\MailboxInterface::class
    );

    echo '<pre>';

    var_dump(
        $mailbox->mailboxes()
    );

    echo '</pre>';

});


$router->get('/mailbox-discovery-test', function () use ($container) {

    $mailbox = $container->get(
        \Sendity\Mail\Contracts\MailboxInterface::class
    );

    $mailboxes = $mailbox->mailboxes();

    $discovery = new \Sendity\Mail\MailboxDiscovery(
        $mailboxes,
        $container->get(\Sendity\Core\Config::class)
    );

    echo '<pre>';

    print_r(
        $discovery->resolve()
    );

    echo '</pre>';

});


$router->get('/mail-manager-test', function () use ($container) {

    $mail = $container->get(
        \Sendity\Mail\MailManager::class
    );

    return
        'Transport: ' .
        $mail->transportName()
        .
        '<br>Mailbox: ' .
        get_class(
            $mail->mailbox()->driver()
        );

});


$router->get('/message-id-test', function () use ($container) {

    $generator = $container->get(
        \Sendity\Mail\MessageIdGenerator::class
    );

    return $generator->generate();

});


$router->get('/message-test', function () {

    $message = new \Sendity\Mail\MailMessage();

    return $message->id();

});

$router->get('/queue-worker-test', function () use ($container) {

    $queue = $container->get(
        \Sendity\Queue\QueueManager::class
    );

    $queue->dispatch(
        new \Sendity\Queue\Jobs\TestJob()
    );


    $worker = $container->get(
        \Sendity\Queue\QueueWorker::class
    );


    return $worker->work()
        ? 'Queue worker executed job'
        : 'Nothing processed';

});

$router->get('/boom', function () {
    throw new RuntimeException('Boom!');
});