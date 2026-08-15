<?php

declare(strict_types=1);

namespace Sendity\Domain\Mailbox;

use InvalidArgumentException;
use Sendity\Domain\Identity\Identity;

final class Mailbox
{
    private readonly string $name;

    public function __construct(
        private readonly Identity $identity,
        string $name,
    ) {
        $name = trim($name);

        if ($name === '') {
            throw new InvalidArgumentException(
                'Mailbox name cannot be empty.'
            );
        }

        $this->name = $name;
    }

    public function identity(): Identity
    {
        return $this->identity;
    }

    public function name(): string
    {
        return $this->name;
    }
}