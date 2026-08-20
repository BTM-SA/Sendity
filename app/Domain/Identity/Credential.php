<?php

declare(strict_types=1);

namespace Sendity\Domain\Identity;

use DateTimeImmutable;
use Sendity\Domain\Identity\Enums\AuthenticationMethod;
use Sendity\Domain\Identity\Enums\CredentialStatus;

final class Credential
{
    private CredentialStatus $status;

    private ?DateTimeImmutable $lastSuccessfulAuthenticationAt = null;

    private ?DateTimeImmutable $lastFailedAuthenticationAt = null;

    private readonly DateTimeImmutable $createdAt;

    public function __construct(
        private readonly Identity $identity,
        private readonly AuthenticationMethod $authenticationMethod,
    ) {
        $this->status = CredentialStatus::PENDING;
        $this->createdAt = new DateTimeImmutable();
    }

    public function identity(): Identity
    {
        return $this->identity;
    }

    public function authenticationMethod(): AuthenticationMethod
    {
        return $this->authenticationMethod;
    }

    public function status(): CredentialStatus
    {
        return $this->status;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function lastSuccessfulAuthenticationAt(): ?DateTimeImmutable
    {
        return $this->lastSuccessfulAuthenticationAt;
    }

    public function lastFailedAuthenticationAt(): ?DateTimeImmutable
    {
        return $this->lastFailedAuthenticationAt;
    }

    public function authenticated(?DateTimeImmutable $at = null): void
    {
        $this->status = CredentialStatus::HEALTHY;
        $this->lastSuccessfulAuthenticationAt = $at ?? new DateTimeImmutable();
    }

    public function authenticationFailed(?DateTimeImmutable $at = null): void
    {
        $this->status = CredentialStatus::AUTHENTICATION_FAILED;
        $this->lastFailedAuthenticationAt = $at ?? new DateTimeImmutable();
    }

    public function needsAttention(): void
    {
        $this->status = CredentialStatus::NEEDS_ATTENTION;
    }
}
