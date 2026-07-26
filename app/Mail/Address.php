<?php

declare(strict_types=1);

namespace Sendity\Mail;

class Address
{
    public function __construct(
        private string $email,
        private ?string $name = null
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function hasName(): bool
    {
        return $this->name !== null && $this->name !== '';
    }

    public function __toString(): string
    {
        if ($this->hasName()) {
            return sprintf('%s <%s>', $this->name, $this->email);
        }

        return $this->email;
    }
}