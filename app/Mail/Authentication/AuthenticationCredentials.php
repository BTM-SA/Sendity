<?php

declare(strict_types=1);

namespace Sendity\Mail\Authentication;

final class AuthenticationCredentials
{
    public function __construct(
        protected string $username,
        protected string $password
    ) {
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }
}
