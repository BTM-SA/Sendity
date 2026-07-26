<?php

declare(strict_types=1);

namespace Sendity\Mail;

interface MailerInterface
{
    public function send(MailMessage $message): void;
}






