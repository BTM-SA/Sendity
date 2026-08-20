<?php

declare(strict_types=1);

namespace Sendity\Mail\Contracts;

use Sendity\Mail\Authentication\AuthenticationCredentials;

interface MailAuthenticatorInterface
{
    /**
     * Authenticate the supplied credentials against the configured mailbox service.
     */
    public function authenticate(AuthenticationCredentials $credentials): void;
}
