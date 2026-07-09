<?php

namespace Sendity\Listeners;

use Sendity\Core\Events\Contracts\EventInterface;
use Sendity\Core\Events\Contracts\ListenerInterface;
use Sendity\Events\MailSent;
use Sendity\Services\Logger;

class LogMailSent implements ListenerInterface
{
    public function handle(EventInterface $event): void
    {
        /** @var MailSent $event */

        Logger::info(sprintf(
            'Mail sent to %s with subject "%s"',
            $event->recipient,
            $event->subject
        ));
    }
}