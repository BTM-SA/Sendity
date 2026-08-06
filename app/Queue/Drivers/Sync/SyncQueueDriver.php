<?php

declare(strict_types=1);

namespace Sendity\Queue\Drivers\Sync;

use Sendity\Queue\Contracts\QueueDriverInterface;
use Sendity\Queue\JobEnvelope;

class SyncQueueDriver implements QueueDriverInterface
{
    private array $jobs = [];


    public function push(
        JobEnvelope $job
    ): void {

        $this->jobs[] = $job;
    }


    public function pop(): ?JobEnvelope
    {
        return array_shift(
            $this->jobs
        );
    }


    public function delete(
        JobEnvelope $job
    ): void {
        //
    }


    public function release(
        JobEnvelope $job
    ): void {

        $this->jobs[] = $job;

    }


    public function size(): int
    {
        return count(
            $this->jobs
        );
    }
}