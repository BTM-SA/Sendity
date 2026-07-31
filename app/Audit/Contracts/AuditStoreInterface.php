<?php

declare(strict_types=1);

namespace Sendity\Audit\Contracts;

use Sendity\Audit\AuditRecord;
use Sendity\Mail\MailMessage;

interface AuditStoreInterface
{
    /**
     * Persist a message audit record.
     */
    public function save(
        MailMessage $message
    ): void;


    /**
     * Retrieve an audit record by message ID.
     */
    public function load(
        string $messageId
    ): ?AuditRecord;
}