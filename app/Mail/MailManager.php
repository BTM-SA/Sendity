<?php

declare(strict_types=1);

namespace Sendity\Mail;

use Sendity\Mail\Contracts\MailerInterface;
use Sendity\Queue\QueueManager;

class MailManager implements MailerInterface
{
    public function __construct(
        protected DeliveryManager $delivery,
        protected MailboxManager $mailbox,
        protected QueueManager $queue
    ) {
    }

    public function send(
        MailMessage $message
    ): void {
        $this->delivery->deliver(
            $message,
            new DeliveryContext()
        );
    }

    public function queue(
        MailMessage $message
    ): void {
        $this->queue->dispatch(
            new MailDeliveryJob($message)
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
