<?php

namespace Sendity\Controllers;

use Sendity\Http\Response;
use Sendity\Mail\MailerInterface;
use Sendity\Mail\MailMessage;

class HomeController
{
    public function __construct(
        protected MailerInterface $mailer
    ) {
    }

    public function index(): Response
    {
        return Response::text('Sendity is running');
    }

    public function health(): Response
    {
        return Response::text('OK');
    }

    public function sendTest(): Response
{
    $message = new MailMessage();
$message
    ->to('admin@btm-sa.co.za')
    ->subject('Sendity Test')
    ->text('Testing Sendity Delivery.');

    try {

        $this->mailer->send($message);

        return Response::text(
            'Email sent successfully!'
        );

    } catch (\Throwable $e) {

        return Response::text(
            $e->getMessage()
        );
    }
}
}