<?php

namespace Sendity\Core;

use Sendity\Http\Request;

class Pipeline
{
    protected Request $request;

    /**
     * @var array<object>
     */
    protected array $pipes = [];

    public function send(Request $request): static
    {
        $this->request = $request;

        return $this;
    }

    public function through(array $pipes): static
    {
        $this->pipes = $pipes;

        return $this;
    }

    public function then(callable $destination)
    {
        $pipeline = array_reduce(
            array_reverse($this->pipes),
            function ($next, $pipe) {
                return function (Request $request) use ($pipe, $next) {
                    return $pipe->handle($request, $next);
                };
            },
            $destination
        );

        return $pipeline($this->request);
    }
}