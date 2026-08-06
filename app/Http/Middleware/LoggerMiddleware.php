<?php

declare(strict_types=1);

namespace Sendity\Http\Middleware;

use Sendity\Http\Contracts\MiddlewareInterface;
use Sendity\Http\Request;
use Sendity\Services\Logger;

class LoggerMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, callable $next)
    {
        Logger::info(
            sprintf(
                '%s %s',
                $request->method(),
                $request->path()
            )
        );

        return $next($request);
    }
}