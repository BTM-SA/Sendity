<?php

declare(strict_types=1);

namespace Sendity\Mail\Contracts;

use Sendity\Mail\DeliveryContext;
use Sendity\Mail\MailMessage;

interface DeliveryTransportInterface
{
    public function deliver(
        MailMessage $message,
        DeliveryContext $context
    ): void;
}