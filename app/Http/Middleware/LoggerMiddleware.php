<?php

namespace Sendity\Http\Middleware;

use Sendity\Http\Request;
use Sendity\Services\Logger;

class LoggerMiddleware
{
    public function handle(Request $request): void
    {
        Logger::info(
            sprintf(
                '%s %s',
                $request->method(),
                $request->path()
            )
        );
    }
}