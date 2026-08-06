<?php

declare(strict_types=1);

namespace Sendity\Queue\Drivers\File;

use Sendity\Queue\Contracts\QueueDriverInterface;
use Sendity\Queue\Contracts\QueueStorageInterface;
use Sendity\Queue\JobEnvelope;

class FileQueueDriver implements QueueDriverInterface
{
    public function __construct(
        protected QueueStorageInterface $storage
    ) {
    }


    public function push(
        JobEnvelope $job
    ): void {

        $this->storage->push(
            $job
        );

    }


    public function pop(): ?JobEnvelope
    {
        return $this->storage->pop();
    }


    public function delete(
        JobEnvelope $job
    ): void {

        $this->storage->delete(
            $job
        );

    }


    public function release(
        JobEnvelope $job
    ): void {

        $this->storage->push(
            $job
        );

    }


    public function size(): int
    {
        return $this->storage->size();
    }
}