<?php

declare(strict_types=1);

namespace Sendity\Queue\Retry;

class RetryPolicy
{
    public function __construct(
        protected int $maxAttempts = 3
    ) {
    }


    /**
     * Determine if another attempt is allowed.
     */
    public function shouldRetry(
        int $attempt
    ): bool {

        return $attempt < $this->maxAttempts;
    }


    /**
     * Return the next attempt number.
     */
    public function nextAttempt(
        int $attempt
    ): int {

        return $attempt + 1;
    }


    /**
     * Return retry delay in seconds.
     */
    public function delay(
        int $attempt
    ): int {

        return $attempt * 5;
    }
}