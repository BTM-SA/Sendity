<?php

declare(strict_types=1);

namespace Sendity\Mail;

use Sendity\Mail\Contracts\MailerInterface;

class MailManager implements MailerInterface
{
    public function __construct(
        protected DeliveryManager $delivery,
        protected MailboxManager $mailbox
    ) {
    }


    public function send(
        MailMessage $message
    ): void {
        $this->delivery->deliver(
            $message
        );
    }


    public function mailbox(): MailboxManager
    {
        return $this->mailbox;
    }


    public function transportName(): string
    {
        return get_class(
            $this->delivery->transport()
        );
    }
}