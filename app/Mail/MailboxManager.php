<?php

declare(strict_types=1);

namespace Sendity\Mail;

use Sendity\Core\Config;
use Sendity\Core\Container;
use InvalidArgumentException;

class MailboxManager
{
    public function __construct(
        protected Config $config,
        protected Container $container
    ) {
    }


    public function driver(?string $name = null): \Sendity\Mail\Contracts\MailboxInterface
    {
        $name ??= $this->config->get(
            'mail.mailbox',
            'imap'
        );


        return match ($name) {

            'imap' => $this->container->get(
                \Sendity\Mail\Drivers\IMAP\ImapMailbox::class
            ),


            default => throw new InvalidArgumentException(
                "Unsupported mailbox driver: {$name}"
            ),

        };
    }
}