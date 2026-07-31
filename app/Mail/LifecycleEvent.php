<?php

declare(strict_types=1);

namespace Sendity\Mail;

use DateTimeImmutable;
use Sendity\Mail\Enums\MessageStatus;

class LifecycleEvent
{
    /**
     * @param array<string, mixed> $metadata
     */
    public function __construct(
        protected MessageStatus $status,
        protected DateTimeImmutable $occurredAt,
        protected array $metadata = []
    ) {
    }


    public function status(): MessageStatus
    {
        return $this->status;
    }


    public function occurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }


    /**
     * @return array<string, mixed>
     */
    public function metadata(): array
    {
        return $this->metadata;
    }


    public function addMetadata(
        string $key,
        mixed $value
    ): self {
        $this->metadata[$key] = $value;

        return $this;
    }
}