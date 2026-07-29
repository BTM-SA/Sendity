<?php

declare(strict_types=1);

namespace Sendity\Mail\Drivers\IMAP;

use Sendity\Core\Config;
use Sendity\Mail\Contracts\MailboxInterface;
use Sendity\Mail\MailboxDiscovery;

class ImapClient implements MailboxInterface
{
    protected $connection = null;

    protected array $mailboxes = [];

    protected array $specialFolders = [];

    public function __construct(
        protected Config $config
    ) {
    }

    public function driverName(): string
    {
        return 'imap';
    }

    public function connect(): void
    {
        $imap = $this->config->get('mail.imap');

        $this->connection = imap_open(
            $this->serverString(),
            $imap['username'],
            $imap['password']
        );

        if ($this->connection === false) {
            throw new \RuntimeException(
                imap_last_error() ?: 'Unable to connect to IMAP server.'
            );
        }

        /*
         * Discover available mailboxes.
         */
        $this->mailboxes = $this->discoverMailboxes();

        /*
         * Resolve special folders.
         */
        $this->specialFolders = (new MailboxDiscovery(
            $this->mailboxes,
            $this->config
        ))->resolve();
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
        return array_map(
            function ($mailbox) {
                return preg_replace(
                    '/^\{.*\}/',
                    '',
                    $mailbox->name
                );
            },
            $this->mailboxes
        );
    }

    public function mailboxes(): array
    {
        if ($this->connection === null) {
            $this->connect();
        }

        return $this->mailboxes;
    }

    public function specialFolders(): array
    {
        if ($this->connection === null) {
            $this->connect();
        }

        return $this->specialFolders;
    }

    /**
     * Return the resolved path of a special IMAP folder.
     *
     * @throws \RuntimeException
     */
    protected function specialFolder(string $type): string
    {
        if ($this->connection === null) {
            $this->connect();
        }

        $folder = $this->specialFolders[$type] ?? null;

        if (empty($folder)) {
            throw new \RuntimeException(
                sprintf(
                    'Unable to determine the IMAP %s folder.',
                    ucfirst($type)
                )
            );
        }

        return $folder;
    }

    public function appendSent(string $rawMessage): void
{
    if ($this->connection === null) {
        $this->connect();
    }

    $mailbox = $this->serverString() . $this->specialFolder('sent');

    $result = imap_append(
        $this->connection,
        $mailbox,
        $rawMessage
    );

    if ($result === false) {
        throw new \RuntimeException(
            imap_last_error() ?: 'Unable to append message to Sent folder.'
        );
    }
}

    protected function discoverMailboxes(): array
    {
        $mailboxes = imap_getmailboxes(
            $this->connection,
            $this->serverString(),
            '*'
        );

        if ($mailboxes === false) {
            throw new \RuntimeException(
                imap_last_error() ?: 'Unable to retrieve mailboxes.'
            );
        }

        return $mailboxes;
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

    protected function serverString(): string
    {
        $imap = $this->config->get('mail.imap');

        return sprintf(
            '{%s:%d/imap/%s}',
            $imap['host'],
            $imap['port'],
            $imap['encryption']
        );
    }
}