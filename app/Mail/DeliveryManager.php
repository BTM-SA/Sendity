<?php

declare(strict_types=1);

namespace Sendity\Mail;

use Sendity\Queue\Retry\RetryPolicy;
use Throwable;

class DeliveryManager
{
    public function __construct(
        protected MailTransportManager $transports,
        protected RetryPolicy $retryPolicy
    ) {
    }

    /**
     * Deliver the message using the configured retry policy.
     */
    public function deliver(
        MailMessage $message
    ): void {
        $attempt = 1;

        while (true) {
            $context = new DeliveryContext($attempt);

            try {
                $this->transports
                    ->driver()
                    ->deliver(
                        $message,
                        $context
                    );

                return;
            } catch (Throwable $e) {
                if (!$this->retryPolicy->shouldRetry($attempt)) {
                    throw $e;
                }

                $nextAttempt = $this->retryPolicy->nextAttempt(
                    $attempt
                );

                $delay = $this->retryPolicy->delay(
                    $attempt
                );

                $message
                    ->lifecycle()
                    ->retrying([
                        'attempt' => $attempt,
                        'next_attempt' => $nextAttempt,
                        'delay' => $delay,
                        'error' => $e->getMessage(),
                        'exception' => get_class($e),
                    ]);

                sleep($delay);

                $attempt = $nextAttempt;
            }
        }
    }
}