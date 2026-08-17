<?php

declare(strict_types=1);

namespace Sendity\Mail;

use InvalidArgumentException;

final class DeliveryContext
{
    public function __construct(
        private readonly int $attempt = 1
    ) {
        if ($attempt < 1) {
            throw new InvalidArgumentException(
                'Delivery attempt must be at least 1.'
            );
        }
    }

    public function attempt(): int
    {
        return $this->attempt;
    }
}