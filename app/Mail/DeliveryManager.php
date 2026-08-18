<?php

declare(strict_types=1);

namespace Sendity\Mail;

class DeliveryManager
{
    public function __construct(
        protected MailTransportManager $transports
    ) {
    }

    /**
     * Perform one delivery attempt.
     *
     * Retry orchestration belongs to the queue worker.
     */
    public function deliver(
        MailMessage $message,
        DeliveryContext $context
    ): void {
        $this->transports
            ->driver()
            ->deliver(
                $message,
                $context
            );
    }
}