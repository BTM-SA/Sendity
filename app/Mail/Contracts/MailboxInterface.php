<?php

declare(strict_types=1);

namespace Sendity\Mail\Contracts;

interface MailboxInterface
{
    /**
     * Connect to the mailbox.
     */
    public function connect(): void;

    /**
     * Close the mailbox connection.
     */
    public function disconnect(): void;

    /**
     * Return available folders.
     */
    public function folders(): array;

    /**
     * Save a MIME message to the Sent folder.
     */
    public function appendSent(string $mime): void;
}