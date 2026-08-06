<?php

declare(strict_types=1);

namespace Sendity\Queue;

use InvalidArgumentException;
use Sendity\Core\Config;
use Sendity\Core\Container;
use Sendity\Queue\Contracts\QueueDriverInterface;
use Sendity\Queue\Drivers\File\FileQueueDriver;
use Sendity\Queue\Drivers\Sync\SyncQueueDriver;

class QueueDriverManager
{
    public function __construct(
        protected Config $config,
        protected Container $container
    ) {
    }


    /**
     * Return the configured queue driver.
     */
    public function driver(
        ?string $name = null
    ): QueueDriverInterface {

        $name ??= $this->config->get(
            'queue.default',
            'file'
        );


        return match ($name) {

    'file' => $this->container->get(
        FileQueueDriver::class
    ),


    'sync' => $this->container->get(
        SyncQueueDriver::class
    ),


    default => throw new InvalidArgumentException(
        "Unsupported queue driver: {$name}"
    ),

};
    }
}