<?php

declare(strict_types=1);

namespace Sendity\Controllers;

use Sendity\Http\Response;
use Sendity\Mail\MailerInterface;
use Sendity\Mail\MailMessage;
use Sendity\Mail\MessageIdGenerator;

class HomeController
{
    public function __construct(protected MailerInterface $mailer, protected MessageIdGenerator $messageIdGenerator)
    {
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
        $message = new MailMessage($this->messageIdGenerator);

        $message->to("admin@btm-sa.co.za")->subject("Sendity Test")->text("Testing Sendity Delivery.");

        try {
            $this->mailer->send($message);
            echo '<pre>';
print_r($message->lifecycle()->events());
echo '</pre>';
exit;

            return Response::text("Email sent successfully! ID: " . $message->id());
        } catch (\Throwable $e) {
            return Response::text($e->getMessage());
        }
    }
}
