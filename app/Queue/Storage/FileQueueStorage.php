<?php

declare(strict_types=1);

namespace Sendity\Queue\Storage;

use Sendity\Queue\Contracts\QueueStorageInterface;
use Sendity\Queue\JobEnvelope;

class FileQueueStorage implements QueueStorageInterface
{
    protected string $path;


    public function __construct()
    {
        $this->path = storage_path(
            'queue'
        );


        if (! is_dir($this->path)) {

            mkdir(
                $this->path,
                0755,
                true
            );

        }
    }


    public function push(
        JobEnvelope $job
    ): void {

        file_put_contents(
            $this->file($job->id()),
            serialize($job)
        );

    }


    public function pop(): ?JobEnvelope
    {
        $files = glob(
            $this->path . '/*.queue'
        );


        if (! $files) {

            return null;

        }


        $file = array_shift(
            $files
        );


        $job = unserialize(
            file_get_contents($file)
        );


        unlink($file);


        return $job;
    }


    public function delete(
        JobEnvelope $job
    ): void {

        $file = $this->file(
            $job->id()
        );


        if (file_exists($file)) {

            unlink($file);

        }

    }


    public function size(): int
    {
        return count(
            glob($this->path . '/*.queue') ?: []
        );
    }


    protected function file(
        string $id
    ): string {

        return $this->path
            . DIRECTORY_SEPARATOR
            . $id
            . '.queue';

    }
}