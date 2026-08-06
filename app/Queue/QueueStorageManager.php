<?php

declare(strict_types=1);

namespace Sendity\Queue;

use Sendity\Core\Config;
use Sendity\Core\Container;
use Sendity\Queue\Contracts\QueueStorageInterface;
use Sendity\Queue\Storage\FileQueueStorage;
use InvalidArgumentException;

class QueueStorageManager
{
    public function __construct(
        protected Config $config,
        protected Container $container
    ) {
    }


    public function storage(
        ?string $name = null
    ): QueueStorageInterface {

        $name ??= $this->config->get(
            'queue.storage',
            'file'
        );


        return match ($name) {

            'file' => $this->container->get(
                FileQueueStorage::class
            ),


            default => throw new InvalidArgumentException(
                "Unsupported queue storage: {$name}"
            ),

        };
    }
}