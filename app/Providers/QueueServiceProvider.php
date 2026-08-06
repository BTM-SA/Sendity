<?php

declare(strict_types=1);

namespace Sendity\Providers;

use Sendity\Core\Config;
use Sendity\Core\Providers\ServiceProvider;
use Sendity\Queue\QueueDriverManager;
use Sendity\Queue\QueueManager;
use Sendity\Queue\QueueWorker;
use Sendity\Queue\Drivers\Sync\SyncQueueDriver;
use Sendity\Queue\Retry\RetryPolicy;
use Sendity\Queue\QueueStorageManager;
use Sendity\Queue\Storage\FileQueueStorage;
use Sendity\Queue\Drivers\File\FileQueueDriver;
use Sendity\Queue\Contracts\QueueStorageInterface;

class QueueServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Queue Driver Manager
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            QueueDriverManager::class,
            function ($container) {

                return new QueueDriverManager(
                    $container->get(Config::class),
                    $container
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Sync Queue Driver
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            SyncQueueDriver::class,
            function () {

                return new SyncQueueDriver();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Retry Policy
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            RetryPolicy::class,
            function () {

                return new RetryPolicy(
                    3
                );

            }
        );

/*
|--------------------------------------------------------------------------
| Queue Storage Manager
|--------------------------------------------------------------------------
*/

$this->container->singleton(
    QueueStorageManager::class,
    function ($container) {

        return new QueueStorageManager(
            $container->get(Config::class),
            $container
        );

    }
);


/*
|--------------------------------------------------------------------------
| File Queue Storage
|--------------------------------------------------------------------------
*/

$this->container->singleton(
    FileQueueStorage::class,
    function () {

        return new FileQueueStorage();

    }
);
        
        /*
|--------------------------------------------------------------------------
| File Queue Driver
|--------------------------------------------------------------------------
*/

$this->container->singleton(
    FileQueueDriver::class,
    function ($container) {

        return new FileQueueDriver(
            $container->get(
                QueueStorageManager::class
            )->storage()
        );

    }
);
        
        /*
        |--------------------------------------------------------------------------
        | Queue Manager
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            QueueManager::class,
            function ($container) {

                return new QueueManager(
                    $container->get(QueueDriverManager::class)
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Queue Worker
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            QueueWorker::class,
            function ($container) {

                return new QueueWorker(
                    $container->get(QueueDriverManager::class),
                    $container->get(RetryPolicy::class)
                );

            }
        );
    }


    public function boot(): void
    {
        //
    }
}