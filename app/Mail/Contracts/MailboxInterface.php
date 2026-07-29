<?php

declare(strict_types=1);

namespace Sendity\Mail\Contracts;

interface MailboxInterface
{
    /**
     * Return the driver name.
     */
    public function driverName(): string;

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
     * Return raw mailbox information from the server.
     */
    public function mailboxes(): array;

    /**
     * Save a MIME message to the Sent folder.
     */
    public function appendSent(string $mime): void;
}