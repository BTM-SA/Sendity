<?php

namespace Sendity\Core\Events;

use Sendity\Core\Container;
use Sendity\Core\Events\Contracts\EventInterface;

class EventDispatcher
{
    protected array $listeners = [];

    public function __construct(
        protected Container $container
    ) {}

    public function listen(string $event, string $listener): void
    {
        $this->listeners[$event][] = $listener;
    }

    public function dispatch(EventInterface $event): void
    {
        $eventClass = get_class($event);

        if (! isset($this->listeners[$eventClass])) {
            return;
        }

        foreach ($this->listeners[$eventClass] as $listener) {

            $instance = $this->container->get($listener);

            $instance->handle($event);
        }
    }
}