<?php

declare(strict_types=1);

namespace Sendity\Mail;

use Sendity\Core\Container;
use Sendity\Queue\Contracts\JobInterface;
use Sendity\Queue\JobEnvelope;

final class MailDeliveryJob implements JobInterface
{
    public function __construct(
        private readonly MailMessage $message
    ) {
    }

    public function handle(
        JobEnvelope $envelope,
        Container $container
    ): void {
        $delivery = $container->get(
            DeliveryManager::class
        );

        $delivery->deliver(
            $this->message,
            new DeliveryContext(
                $envelope->attempts()
            )
        );
    }
}
