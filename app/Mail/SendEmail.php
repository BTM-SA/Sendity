<?php

declare(strict_types=1);

namespace Sendity\Mail;

use Sendity\Domain\Message\Message;
use Sendity\Mail\MailManager;
use Sendity\Mail\MailMessage;
use Sendity\Mail\MessageIdGenerator;


final class SendEmail
{
    public function __construct(
        private readonly MailManager $mailManager,
        private readonly MessageIdGenerator $idGenerator,
    ) {
    }

    public function execute(Message $message): void
    {
        $mailMessage = new MailMessage(
            $this->idGenerator
        );

        $sender = $message->sender();

        $mailMessage->from(
            $sender->email(),
            $sender->displayName()
        );

        foreach ($message->recipients() as $recipient) {
            $mailMessage->to(
                $recipient->email(),
                $recipient->displayName()
            );
        }

        $mailMessage
            ->subject($message->subject())
            ->html($message->content());

        $this->mailManager->send(
            $mailMessage
        );
    }
}