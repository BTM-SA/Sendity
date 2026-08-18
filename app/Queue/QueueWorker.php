<?php

declare(strict_types=1);

namespace Sendity\Queue;

use Sendity\Queue\Retry\RetryPolicy;
use Throwable;

class QueueWorker
{
    public function __construct(
        protected QueueDriverManager $drivers,
        protected RetryPolicy $retry
    ) {
    }


    /**
     * Process the next available job.
     */
    public function work(): bool
    {
        $job = $this->drivers
            ->driver()
            ->pop();


        if ($job === null) {

            return false;

        }


        try {

            $job->reserve();


            $job
            ->job()
            ->handle($job);


            $job->complete();


            $this->drivers
                ->driver()
                ->delete($job);


            return true;


        } catch (Throwable $e) {

            $job->recordError(
                $e->getMessage()
            );


            if (
                $job->canRetry()
                &&
                $this->retry->shouldRetry(
                    $job->attempts()
                )
            ) {

                $job->delay(
                    $this->retry->delay(
                        $job->attempts()
                    )
                );


                $this->drivers
                    ->driver()
                    ->release($job);


                return false;

            }


            $job->fail(
                $e->getMessage()
            );


            $this->drivers
                ->driver()
                ->delete($job);


            throw $e;
        }
    }
}