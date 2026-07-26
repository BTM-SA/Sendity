<?php

declare(strict_types=1);

namespace Sendity\Mail\IMAP;

use Sendity\Core\Config;
use Sendity\Mail\Contracts\MailboxInterface;

class ImapClient implements MailboxInterface
{
    public function __construct(
        protected Config $config
    ) {
    }

    public function connect(): void
    {
        //
    }

    public function disconnect(): void
    {
        //
    }

    public function folders(): array
    {
        return [];
    }

    public function saveSent(string $mime): void
    {
        //
    }
}