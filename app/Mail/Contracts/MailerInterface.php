<?php

declare(strict_types=1);

namespace Sendity\Mail\Contracts;

use Sendity\Mail\MailMessage;

interface MailerInterface
{
    public function send(
        MailMessage $message
    ): void;
}