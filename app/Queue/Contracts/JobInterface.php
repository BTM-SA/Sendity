<?php

declare(strict_types=1);

namespace Sendity\Queue\Contracts;

interface JobInterface
{
    /**
     * Execute the job.
     */
    public function handle(): void;
}