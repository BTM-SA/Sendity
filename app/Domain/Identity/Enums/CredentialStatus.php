<?php

declare(strict_types=1);

namespace Sendity\Domain\Identity\Enums;

enum CredentialStatus: string
{
    case PENDING = 'pending';

    case HEALTHY = 'healthy';

    case NEEDS_ATTENTION = 'needs_attention';

    case AUTHENTICATION_FAILED = 'authentication_failed';
}
