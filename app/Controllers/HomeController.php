<?php

declare(strict_types=1);

namespace Sendity\Controllers;

use Sendity\Http\Response;
use Sendity\Domain\Identity\Identity;
use Sendity\Domain\Conversation\Conversation;
use Sendity\Domain\Message\Message;
use Sendity\Mail\SendEmail;

class HomeController
{
    public function __construct(
    protected SendEmail $sendEmail
) {
}

    public function index(): Response
    {
        return Response::text("Sendity is running");
    }

    public function health(): Response
    {
        return Response::text("OK");
    }

    public function sendTest(): Response
{
    $sender = new Identity(
        'cedric@bichet.co.za',
        'Cedric Bichet'
    );

    $recipient = new Identity(
        'admin@btm-sa.co.za',
        'Sendity Admin'
    );

    $conversation = new Conversation(
        $sender,
        'Sendity Test'
    );

    $message = new Message(
        $sender,
        $conversation,
        'Sendity Test',
        'Testing Sendity Delivery.',
        [$recipient]
    );

    try {

        $mailMessage = $this->sendEmail->execute(
            $message
        );

        echo '<pre>';
        print_r(
            $mailMessage->lifecycle()->events()
        );
        echo '</pre>';

        exit;

    } catch (\Throwable $e) {

        return Response::text(
            $e->getMessage()
        );
    }
}
}
