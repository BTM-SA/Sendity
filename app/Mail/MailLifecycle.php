<?php

declare(strict_types=1);

namespace Sendity\Mail;

use DateTimeImmutable;
use Sendity\Mail\Enums\MessageStatus;

class MailLifecycle
{
    private MessageStatus $status;

    private DateTimeImmutable $createdAt;

    private ?DateTimeImmutable $queuedAt = null;

    private ?DateTimeImmutable $sendingAt = null;

    private ?DateTimeImmutable $sentAt = null;

    private ?DateTimeImmutable $failedAt = null;


    /**
     * @var LifecycleEvent[]
     */
    private array $events = [];


    public function __construct()
    {
        $this->status = MessageStatus::CREATED;

        $this->createdAt = new DateTimeImmutable();

        $this->record(
            MessageStatus::CREATED
        );
    }


    public function status(): MessageStatus
    {
        return $this->status;
    }


    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }


    /**
     * @return LifecycleEvent[]
     */
    public function events(): array
    {
        return $this->events;
    }


    public function queued(): void
    {
        $this->status = MessageStatus::QUEUED;

        $this->queuedAt = new DateTimeImmutable();

        $this->record(
            MessageStatus::QUEUED
        );
    }


    /**
 * @param array<string, mixed> $metadata
 */
public function sending(array $metadata = []): void
{
    $this->status = MessageStatus::SENDING;

    $this->sendingAt = new DateTimeImmutable();

    $this->record(
        MessageStatus::SENDING,
        $metadata
    );
}



    /**
     * @param array<string, mixed> $metadata
     */
    public function sent(array $metadata = []): void
    {
        $this->status = MessageStatus::SENT;

        $this->sentAt = new DateTimeImmutable();

        $this->record(
            MessageStatus::SENT,
            $metadata
        );
    }


    /**
 * @param array<string, mixed> $metadata
 */
public function failed(array $metadata = []): void
{
    $this->status = MessageStatus::FAILED;

    $this->failedAt = new DateTimeImmutable();

    $this->record(
        MessageStatus::FAILED,
        $metadata
    );
}
/**
 * @param array<string, mixed> $metadata
 */
public function retrying(array $metadata = []): void
{
    $this->status = MessageStatus::RETRYING;

    $this->record(
        MessageStatus::RETRYING,
        $metadata
    );
}
    public function queuedAt(): ?DateTimeImmutable
    {
        return $this->queuedAt;
    }


    public function sendingAt(): ?DateTimeImmutable
    {
        return $this->sendingAt;
    }


    public function sentAt(): ?DateTimeImmutable
    {
        return $this->sentAt;
    }


    public function failedAt(): ?DateTimeImmutable
    {
        return $this->failedAt;
    }


    /**
     * @param array<string, mixed> $metadata
     */
    protected function record(
        MessageStatus $status,
        array $metadata = []
    ): void {
        $this->events[] = new LifecycleEvent(
            $status,
            new DateTimeImmutable(),
            $metadata
        );
    }
}