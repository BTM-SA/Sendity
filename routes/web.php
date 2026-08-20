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
$router->get('/identity-test', function () {

    $identity = new \Sendity\Domain\Identity\Identity(
        'alex@company.com',
        'Alex Botha'
    );

    return
        'Email: ' . $identity->email()
        . '<br>Name: ' . $identity->displayName();
});
$router->get('/mailbox-test', function () {

    $identity = new \Sendity\Domain\Identity\Identity(
        'alex@company.com',
        'Alex Botha'
    );

    $mailbox = new \Sendity\Domain\Mailbox\Mailbox(
        $identity,
        'Alex Mailbox'
    );

    return
        'Mailbox: ' . $mailbox->name()
        . '<br>Email: ' . $mailbox->identity()->email()
        . '<br>Name: ' . $mailbox->identity()->displayName();
});
$router->get('/conversation-test', function () {

    $identity = new \Sendity\Domain\Identity\Identity(
        'alex@company.com',
        'Alex Botha'
    );

    $conversation = new \Sendity\Domain\Conversation\Conversation(
        $identity,
        'Invoice Discussion'
    );

    return
        'Conversation: ' . $conversation->subject()
        . '<br>Email: ' . $conversation->identity()->email()
        . '<br>Name: ' . $conversation->identity()->displayName();
});
$router->get('/domain-message-test', function () {

    $sender = new \Sendity\Domain\Identity\Identity(
        'alex@company.com',
        'Alex Botha'
    );

    $recipient = new \Sendity\Domain\Identity\Identity(
        'client@example.com',
        'Client'
    );

    $conversation = new \Sendity\Domain\Conversation\Conversation(
        $sender,
        'Invoice Discussion'
    );

    $message = new \Sendity\Domain\Message\Message(
        $sender,
        $conversation,
        'Invoice #1001',
        'Please find the invoice attached.',
        [$recipient]
    );

    return
        'Subject: ' . $message->subject()
        . '<br>From: ' . $message->sender()->email()
        . '<br>To: ' . $message->recipients()[0]->email()
        . '<br>Conversation: ' . $message->conversation()->subject()
        . '<br>Content: ' . $message->content();
});
$router->get('/domain-send-resolve-test', function () use ($container) {

    $sendEmail = $container->get(
        \Sendity\Mail\SendEmail::class
    );

    return get_class($sendEmail);
});
$router->get('/domain-send-test', function () use ($container) {

    $sender = new \Sendity\Domain\Identity\Identity(
        'alex@company.com',
        'Alex Botha'
    );

    $recipient = new \Sendity\Domain\Identity\Identity(
        'client@example.com',
        'Client'
    );

    $conversation = new \Sendity\Domain\Conversation\Conversation(
        $sender,
        'Invoice Discussion'
    );

    $message = new \Sendity\Domain\Message\Message(
        $sender,
        $conversation,
        'Invoice #1001',
        'Please find the invoice attached.',
        [$recipient]
    );

    $sendEmail = $container->get(
        \Sendity\Mail\SendEmail::class
    );

    $sendEmail->execute($message);

    return 'Domain message sent successfully';
});
$router->get('/credential-test', function () {

    $identity = new \Sendity\Domain\Identity\Identity(
        'alex@company.com',
        'Alex Botha'
    );

    $credential = new \Sendity\Domain\Identity\Credential(
        $identity,
        \Sendity\Domain\Identity\Enums\AuthenticationMethod::PASSWORD
    );

    $createdStatus = $credential->status()->value;

    $credential->authenticated();

    $healthyStatus = $credential->status()->value;
    $authenticatedAt = $credential->lastSuccessfulAuthenticationAt();

    $credential->authenticationFailed();

    $failedStatus = $credential->status()->value;
    $failedAt = $credential->lastFailedAuthenticationAt();

    return
        'Identity: ' . $credential->identity()->email()
        . '<br>Method: ' . $credential->authenticationMethod()->value
        . '<br>Initial status: ' . $createdStatus
        . '<br>Healthy status: ' . $healthyStatus
        . '<br>Authenticated at: ' . $authenticatedAt?->format(DATE_ATOM)
        . '<br>Failed status: ' . $failedStatus
        . '<br>Failed at: ' . $failedAt?->format(DATE_ATOM);
});
$router->get('/credential-authentication-test', function () use ($container) {

    $config = $container->get(
        \Sendity\Core\Config::class
    );

    $imap = $config->get('mail.imap');

    $identity = new \Sendity\Domain\Identity\Identity(
        $imap['username'],
        $imap['username']
    );

    $credential = new \Sendity\Domain\Identity\Credential(
        $identity,
        \Sendity\Domain\Identity\Enums\AuthenticationMethod::PASSWORD
    );

    $credentials = new \Sendity\Mail\Authentication\AuthenticationCredentials(
        $imap['username'],
        $imap['password']
    );

    $authentication = $container->get(
        \Sendity\Services\Identity\CredentialAuthenticationService::class
    );

    $authentication->authenticate(
        $credential,
        $credentials
    );

    return
        'Identity: ' . $credential->identity()->email()
        . '<br>Status: ' . $credential->status()->value
        . '<br>Authenticated at: ' . $credential->lastSuccessfulAuthenticationAt()?->format(DATE_ATOM);
});
$router->get('/boom', function () {
    throw new RuntimeException('Boom!');
});