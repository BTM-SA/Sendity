<?php

declare(strict_types=1);

namespace Sendity\Queue\Jobs;

use Sendity\Queue\Contracts\JobInterface;
use Sendity\Queue\JobEnvelope;

class TestJob implements JobInterface
{
    public function handle(JobEnvelope $envelope): void
    {
        file_put_contents(
            storage_path('queue-test.txt'),
            "Queue worker executed successfully\n",
            FILE_APPEND
        );
    }
}