<?php

declare(strict_types=1);

namespace Sendity\Domain\Conversation;

use InvalidArgumentException;
use Sendity\Domain\Identity\Identity;

final class Conversation
{
    private readonly string $subject;

    public function __construct(
        private readonly Identity $identity,
        string $subject,
    ) {
        $subject = trim($subject);

        if ($subject === '') {
            throw new InvalidArgumentException(
                'Conversation subject cannot be empty.'
            );
        }

        $this->subject = $subject;
    }

    public function identity(): Identity
    {
        return $this->identity;
    }

    public function subject(): string
    {
        return $this->subject;
    }
}