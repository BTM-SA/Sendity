<?php

declare(strict_types=1);

namespace Sendity\Mail\Enums;

enum MessageStatus: string
{
    case CREATED = 'created';

    case QUEUED = 'queued';

    case SENDING = 'sending';

    case SENT = 'sent';

    case FAILED = 'failed';
}