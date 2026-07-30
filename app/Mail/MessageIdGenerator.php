<?php

declare(strict_types=1);

namespace Sendity\Mail;

class MessageIdGenerator
{
    public function generate(): string
    {
        return 'snd_' . bin2hex(
            random_bytes(16)
        );
    }
}