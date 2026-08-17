<?php

declare(strict_types=1);

namespace Sendity\Mail;

use InvalidArgumentException;
use Sendity\Core\Config;
use Sendity\Core\Container;
use Sendity\Mail\Contracts\DeliveryTransportInterface;

class MailTransportManager
{
    public function __construct(
        protected Config $config,
        protected Container $container
    ) {
    }

    public function driver(
        ?string $name = null
    ): DeliveryTransportInterface {
        $name ??= $this->config->get(
            'mail.default',
            'smtp'
        );

        return match ($name) {

            'smtp' => $this->container->get(
                \Sendity\Mail\Drivers\SMTP\SmtpTransport::class
            ),

            default => throw new InvalidArgumentException(
                "Unsupported mail transport: {$name}"
            ),

        };
    }
}