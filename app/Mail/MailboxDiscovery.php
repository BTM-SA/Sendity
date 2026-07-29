<?php

declare(strict_types=1);

namespace Sendity\Mail;

use Sendity\Core\Config;

class MailboxDiscovery
{
    protected const MATCHES = [

        'sent' => [
            'sent',
            'sent items',
            'sent mail',
        ],

        'drafts' => [
            'drafts',
            'draft',
        ],

        'trash' => [
            'trash',
            'deleted',
            'deleted items',
            'bin',
        ],

        'junk' => [
            'junk',
            'spam',
        ],

        'archive' => [
            'archive',
            'all mail',
        ],

    ];

    public function __construct(
        protected array $mailboxes,
        protected Config $config
    ) {
    }

    public function resolve(): array
    {
        return [
            'sent'    => $this->resolveFolder('sent'),
            'drafts'  => $this->resolveFolder('drafts'),
            'trash'   => $this->resolveFolder('trash'),
            'junk'    => $this->resolveFolder('junk'),
            'archive' => $this->resolveFolder('archive'),
        ];
    }

    protected function resolveFolder(string $type): ?string
    {
        $mailboxes = $this->normalisedMailboxes();

        /*
         * 1. User override
         *
         * User configuration takes priority,
         * but only if the folder actually exists.
         */
        $configured = $this->config->get(
            "mail.imap.{$type}_folder"
        );

        if (!empty($configured)) {

            foreach ($mailboxes as $mailbox) {

                if (
                    strtolower($mailbox['path']) ===
                    strtolower($configured)
                ) {
                    return $mailbox['path'];
                }

            }
        }


        /*
         * 2. Automatic discovery
         */
        foreach ($mailboxes as $mailbox) {

            foreach (self::MATCHES[$type] as $match) {

                if (
                    strtolower($mailbox['name']) ===
                    strtolower($match)
                ) {
                    return $mailbox['path'];
                }

            }

        }


        return null;
    }

    protected function normalisedMailboxes(): array
    {
        return array_map(
            function ($mailbox) {

                $path = preg_replace(
                    '/^\{.*\}/',
                    '',
                    $mailbox->name
                );

                $parts = explode(
                    $mailbox->delimiter,
                    $path
                );

                return [
                    'path' => $path,
                    'name' => end($parts),
                    'delimiter' => $mailbox->delimiter,
                    'attributes' => $mailbox->attributes,
                ];

            },
            $this->mailboxes
        );
    }
}