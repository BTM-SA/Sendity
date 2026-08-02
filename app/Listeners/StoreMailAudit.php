<?php

declare(strict_types=1);

namespace Sendity\Listeners;

use Sendity\Audit\AuditManager;
use Sendity\Core\Events\Contracts\EventInterface;
use Sendity\Core\Events\Contracts\ListenerInterface;
use Sendity\Events\MailSent;

class StoreMailAudit implements ListenerInterface
{
    public function __construct(
        protected AuditManager $audit
    ) {
    }

    public function handle(EventInterface $event): void
    {
        /** @var MailSent $event */

        $this->audit->save(
            $event->message()
        );
    }
}