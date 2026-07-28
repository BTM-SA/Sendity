<?php

declare(strict_types=1);

namespace Sendity\Mail\Drivers\IMAP;

use Sendity\Core\Config;
use Sendity\Mail\Contracts\MailboxInterface;

class NativeImapClient implements MailboxInterface
{
    protected $connection = null;

    public function __construct(
        protected Config $config
    ) {
    }

    public function connect(): void
    {
        $imap = $this->config->get('mail.imap');

        $this->connection = imap_open(
            $this->mailboxString(),
            $imap['username'],
            $imap['password']
        );

        if ($this->connection === false) {
            throw new \RuntimeException(
                imap_last_error() ?: 'Unable to connect to IMAP server.'
            );
        }
    }

    public function disconnect(): void
    {
        if ($this->connection !== null) {
            imap_close($this->connection);
            $this->connection = null;
        }
    }

    public function folders(): array
    {
        if ($this->connection === null) {
            $this->connect();
        }

        $folders = imap_list(
            $this->connection,
            $this->mailboxString(),
            '*'
        );

        if ($folders === false) {
            throw new \RuntimeException(
                imap_last_error() ?: 'Unable to retrieve folders.'
            );
        }

        return $folders;
    }

    public function appendSent(string $rawMessage): void
    {
        if ($this->connection === null) {
            $this->connect();
        }

        // We will implement imap_append here next.
    }

    protected function mailboxString(): string
    {
        $imap = $this->config->get('mail.imap');

        return sprintf(
            '{%s:%d/imap/%s}%s',
            $imap['host'],
            $imap['port'],
            $imap['encryption'],
            $imap['sent_folder']
        );
    }
}