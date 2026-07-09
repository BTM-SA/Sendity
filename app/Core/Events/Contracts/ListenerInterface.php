<?php

namespace Sendity\Core\Events\Contracts;

interface ListenerInterface
{
    public function handle(EventInterface $event): void;
}