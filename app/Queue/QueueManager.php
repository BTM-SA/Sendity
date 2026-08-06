<?php

declare(strict_types=1);

namespace Sendity\Queue;

use Sendity\Queue\Contracts\JobInterface;

class QueueManager
{
    public function __construct(
        protected QueueDriverManager $drivers
    ) {
    }


    /**
     * Dispatch a job onto the queue.
     */
    public function dispatch(
        JobInterface $job
    ): void {

        $envelope = new JobEnvelope(
            $job
        );


        $this->drivers
            ->driver()
            ->push($envelope);
    }


    /**
     * Return the active queue driver.
     */
    public function driver(): object
    {
        return $this->drivers
            ->driver();
    }
}