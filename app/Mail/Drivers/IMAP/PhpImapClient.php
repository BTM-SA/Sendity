<?php

declare(strict_types=1);

namespace Sendity\Mail\Drivers\IMAP;

use Sendity\Core\Config;
use Sendity\Mail\Contracts\MailboxInterface;

class PhpImapClient implements MailboxInterface
{
    public function __construct(
        protected Config $config
    ) {
    }

    public function connect(): void
    {
        throw new \RuntimeException(
            'PHP IMAP driver is not implemented yet.'
        );
    }

    public function disconnect(): void
    {
    }

    public function folders(): array
    {
        return [];
    }

    public function appendSent(string $mime): void
    {
        throw new \RuntimeException(
            'PHP IMAP driver is not implemented yet.'
        );
    }
}