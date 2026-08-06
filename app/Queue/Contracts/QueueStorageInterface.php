<?php

declare(strict_types=1);

namespace Sendity\Queue\Contracts;

use Sendity\Queue\JobEnvelope;

interface QueueStorageInterface
{
    /**
     * Store a job envelope.
     */
    public function push(
        JobEnvelope $job
    ): void;


    /**
     * Retrieve the next available job.
     */
    public function pop(): ?JobEnvelope;


    /**
     * Remove a completed job.
     */
    public function delete(
        JobEnvelope $job
    ): void;


    /**
     * Return the number of queued jobs.
     */
    public function size(): int;
}