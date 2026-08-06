<?php

declare(strict_types=1);

namespace Sendity\Queue\Contracts;

use Sendity\Queue\JobEnvelope;

interface QueueInterface
{
    /**
     * Dispatch a job onto the queue.
     */
    public function dispatch(
        JobInterface $job
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
     * Release a failed job back onto the queue.
     */
    public function release(
        JobEnvelope $job
    ): void;
}