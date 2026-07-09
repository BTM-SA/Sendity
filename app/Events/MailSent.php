<?php

namespace Sendity\Events;

use Sendity\Core\Events\Contracts\EventInterface;

class MailSent implements EventInterface
{
    public function __construct(
        public readonly string $recipient,
        public readonly string $subject
    ) {
    }
}