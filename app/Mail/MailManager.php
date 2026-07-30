<?php

declare(strict_types=1);

namespace Sendity\Mail;

class MailManager
{
    public function __construct(
        protected MailTransportManager $transport,
        protected MailboxManager $mailbox
    ) {
    }


    public function transport(): MailTransportManager
    {
        return $this->transport;
    }


    public function mailbox(): MailboxManager
    {
        return $this->mailbox;
    }
}