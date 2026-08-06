<?php

declare(strict_types=1);

namespace Sendity\Queue\Contracts;

use Sendity\Queue\JobEnvelope;

interface QueueDriverInterface
{
    /**
     * Push a job onto the queue.
     */
    public function push(
        JobEnvelope $job
    ): void;


    /**
     * Retrieve the next available job.
     */
    public function pop(): ?JobEnvelope;


    /**
     * Delete a completed job.
     */
    public function delete(
        JobEnvelope $job
    ): void;


    /**
     * Release a failed job.
     */
    public function release(
        JobEnvelope $job
    ): void;


    /**
     * Return number of queued jobs.
     */
    public function size(): int;
}