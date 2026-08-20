<?php

declare(strict_types=1);

namespace Sendity\Domain\Identity\Enums;

enum AuthenticationMethod: string
{
    case PASSWORD = 'password';

    case APPLICATION_PASSWORD = 'application_password';

    case OAUTH = 'oauth';
}
