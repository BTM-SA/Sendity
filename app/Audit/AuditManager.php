<?php

declare(strict_types=1);

namespace Sendity\Audit;

use Sendity\Audit\Contracts\AuditStoreInterface;
use Sendity\Mail\MailMessage;

class AuditManager
{
    public function __construct(
        protected AuditStoreInterface $store
    ) {
    }


    /**
     * Store the message audit history.
     */
    public function save(
        MailMessage $message
    ): void {
        $this->store->save($message);
    }


    /**
     * Retrieve an audit record.
     */
    public function find(
        string $messageId
    ): ?AuditRecord {
        return $this->store->load($messageId);
    }
}