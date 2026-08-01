<?php

declare(strict_types=1);

namespace Sendity\Events;

use Throwable;

class MailFailed extends MailEvent
{
    public function __construct(
        \Sendity\Mail\MailMessage $message,
        public readonly Throwable $exception
    ) {
        parent::__construct($message);
    }
}