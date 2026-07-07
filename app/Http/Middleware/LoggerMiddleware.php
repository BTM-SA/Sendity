<?php

namespace Sendity\Http\Middleware;

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