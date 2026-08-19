<?php

declare(strict_types=1);

namespace Sendity\Queue\Contracts;

use Sendity\Core\Container;
use Sendity\Queue\JobEnvelope;

interface JobInterface
{
    /**
     * Execute the job.
     */
    public function handle(
        JobEnvelope $envelope,
        Container $container
    ): void;
}
