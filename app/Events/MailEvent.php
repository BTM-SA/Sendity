<?php

declare(strict_types=1);

namespace Sendity\Events;

use Sendity\Core\Events\Contracts\EventInterface;
use Sendity\Mail\MailMessage;

abstract class MailEvent implements EventInterface
{
    public function __construct(
        protected readonly MailMessage $message
    ) {
    }


    public function message(): MailMessage
    {
        return $this->message;
    }
}