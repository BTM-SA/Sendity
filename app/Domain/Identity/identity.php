<?php

declare(strict_types=1);

namespace Sendity\Domain\Identity;

use InvalidArgumentException;

final class Identity
{
    private readonly string $email;
    private readonly ?string $displayName;

    public function __construct(
        string $email,
        ?string $displayName = null,
    ) {
        $email = trim($email);

        if ($email === '') {
            throw new InvalidArgumentException(
                'Identity email address cannot be empty.'
            );
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException(
                'Identity email address must be a valid email address.'
            );
        }

        $this->email = $email;
        $this->displayName = $displayName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function displayName(): ?string
    {
        return $this->displayName;
    }
}