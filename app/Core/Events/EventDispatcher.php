<?php

namespace Sendity\Core\Events;

use Sendity\Core\Container;
use Sendity\Core\Events\Contracts\EventInterface;
use Sendity\Services\Logger;
use Throwable;

class EventDispatcher
{
    protected array $listeners = [];

    public function __construct(
        protected Container $container,
        protected Logger $logger
    ) {
    }


    public function listen(
        string $event,
        string $listener
    ): void {
        $this->listeners[$event][] = $listener;
    }


    public function dispatch(
        EventInterface $event
    ): void {

        $eventClass = get_class($event);

        if (!isset($this->listeners[$eventClass])) {
            return;
        }


        foreach ($this->listeners[$eventClass] as $listener) {

            try {

                $instance = $this->container->get($listener);

                $instance->handle($event);

            } catch (Throwable $e) {

                $this->logger->error(
                    sprintf(
                        'Event listener failed [%s]: %s',
                        $listener,
                        $e->getMessage()
                    )
                );
            }
        }
    }
}