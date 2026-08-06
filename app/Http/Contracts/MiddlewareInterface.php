<?php

declare(strict_types=1);

namespace Sendity\Http\Contracts;

use Sendity\Http\Request;

interface MiddlewareInterface
{
    public function handle(
        Request $request,
        callable $next
    );
}