<?php

declare(strict_types=1);

namespace Sendity\Services\Identity;

use Sendity\Domain\Identity\Credential;
use Sendity\Mail\Authentication\AuthenticationCredentials;
use Sendity\Mail\Contracts\MailAuthenticatorInterface;
use Sendity\Mail\Exceptions\AuthenticationException;
use Sendity\Mail\Exceptions\MailboxException;

final class CredentialAuthenticationService
{
    public function __construct(
        private readonly MailAuthenticatorInterface $authenticator,
    ) {
    }

    public function authenticate(
        Credential $credential,
        AuthenticationCredentials $credentials,
    ): void {
        try {
            $this->authenticator->authenticate($credentials);
            $credential->authenticated();
        } catch (AuthenticationException $exception) {
            $credential->authenticationFailed();
            throw $exception;
        } catch (MailboxException $exception) {
            $credential->needsAttention();
            throw $exception;
        }
    }
}
