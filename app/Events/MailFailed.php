<?php

declare(strict_types=1);

namespace Sendity\Events;

use Sendity\Core\Events\Contracts\EventInterface;
use Sendity\Mail\MailMessage;
use Throwable;

class MailFailed implements EventInterface
{
    public function __construct(
        public readonly MailMessage $message,
        public readonly Throwable $exception
    ) {
    }
}