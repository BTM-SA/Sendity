<?php

declare(strict_types=1);

namespace Sendity\Queue;

use DateTimeImmutable;
use Sendity\Queue\Contracts\JobInterface;

class JobEnvelope
{
    private string $id;

    private int $attempts = 0;

    private int $maxAttempts = 3;

    private DateTimeImmutable $createdAt;

    private ?DateTimeImmutable $availableAt = null;

    private ?DateTimeImmutable $reservedAt = null;

    private ?DateTimeImmutable $completedAt = null;

    private ?DateTimeImmutable $failedAt = null;

    private ?string $lastError = null;


    public function __construct(
        protected JobInterface $job,
        protected string $queue = 'default'
    ) {
        $this->id = bin2hex(random_bytes(16));

        $this->createdAt = new DateTimeImmutable();
    }


    public function id(): string
    {
        return $this->id;
    }


    public function job(): JobInterface
    {
        return $this->job;
    }


    public function queue(): string
    {
        return $this->queue;
    }


    public function attempts(): int
    {
        return $this->attempts;
    }


    public function maxAttempts(): int
    {
        return $this->maxAttempts;
    }


    public function setMaxAttempts(
        int $attempts
    ): void {

        $this->maxAttempts = $attempts;

    }


    public function incrementAttempts(): void
    {
        $this->attempts++;
    }


    public function canRetry(): bool
    {
        return $this->attempts < $this->maxAttempts;
    }


    public function lastError(): ?string
    {
        return $this->lastError;
    }


    public function recordError(
        string $error
    ): void {

        $this->lastError = $error;

    }


    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }


    public function availableAt(): ?DateTimeImmutable
    {
        return $this->availableAt;
    }


    public function reservedAt(): ?DateTimeImmutable
    {
        return $this->reservedAt;
    }


    public function completedAt(): ?DateTimeImmutable
    {
        return $this->completedAt;
    }


    public function failedAt(): ?DateTimeImmutable
    {
        return $this->failedAt;
    }


    public function delay(
        int $seconds
    ): void {

        $this->availableAt = new DateTimeImmutable(
            "+{$seconds} seconds"
        );

    }


    public function reserve(): void
    {
        $this->reservedAt = new DateTimeImmutable();

        $this->incrementAttempts();
    }


    public function complete(): void
    {
        $this->completedAt = new DateTimeImmutable();
    }


    public function fail(
        ?string $error = null
    ): void {

        if ($error !== null) {

            $this->recordError(
                $error
            );

        }


        $this->failedAt = new DateTimeImmutable();
    }
}