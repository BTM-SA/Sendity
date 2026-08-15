<?php

declare(strict_types=1);

namespace Sendity\Domain\Message;

use InvalidArgumentException;
use Sendity\Domain\Conversation\Conversation;
use Sendity\Domain\Identity\Identity;

final class Message
{
    private readonly string $subject;
    private readonly string $content;

    /**
     * @param Identity[] $recipients
     */
    public function __construct(
        private readonly Identity $sender,
        private readonly Conversation $conversation,
        string $subject,
        string $content,
        private readonly array $recipients,
    ) {
        $subject = trim($subject);
        $content = trim($content);

        if ($subject === '') {
            throw new InvalidArgumentException(
                'Message subject cannot be empty.'
            );
        }

        if ($content === '') {
            throw new InvalidArgumentException(
                'Message content cannot be empty.'
            );
        }

        if ($recipients === []) {
            throw new InvalidArgumentException(
                'Message must have at least one recipient.'
            );
        }

        foreach ($recipients as $recipient) {
            if (!$recipient instanceof Identity) {
                throw new InvalidArgumentException(
                    'Message recipients must be Identity instances.'
                );
            }
        }

        $this->subject = $subject;
        $this->content = $content;
    }

    public function sender(): Identity
    {
        return $this->sender;
    }

    public function conversation(): Conversation
    {
        return $this->conversation;
    }

    public function subject(): string
    {
        return $this->subject;
    }

    public function content(): string
    {
        return $this->content;
    }

    /**
     * @return Identity[]
     */
    public function recipients(): array
    {
        return $this->recipients;
    }
}