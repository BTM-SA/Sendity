<?php

declare(strict_types=1);

namespace Sendity\Mail;

use Throwable;

class DeliveryManager
{
    public function __construct(
        protected MailTransportManager $transports
    ) {
    }


    /**
     * Perform one delivery attempt.
     */
    public function deliver(
        MailMessage $message
    ): void {

        try {

            $this->transports
                ->driver()
                ->send($message);

        } catch (Throwable $e) {

            $message
                ->lifecycle()
                ->failed([
                    'error'     => $e->getMessage(),
                    'exception' => get_class($e),
                ]);

            throw $e;
        }
    }
}