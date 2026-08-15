<?php

declare(strict_types=1);

namespace Sendity\Mail;

use Sendity\Domain\Message\Message;
use Sendity\Mail\Contracts\MailerInterface;

final class SendEmail
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly MessageIdGenerator $idGenerator,
    ) {
    }

    public function execute(Message $message): MailMessage
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

        $this->mailer->send(
            $mailMessage
        );
        return $mailMessage;
    }
}