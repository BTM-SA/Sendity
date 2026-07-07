<?php

namespace Sendity\Http\Middleware;

use Sendity\Http\Request;

interface MiddlewareInterface
{
    public function handle(Request $request, callable $next);
}