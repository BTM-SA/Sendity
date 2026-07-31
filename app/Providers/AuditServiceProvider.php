<?php

declare(strict_types=1);

namespace Sendity\Providers;

use Sendity\Audit\Contracts\AuditStoreInterface;
use Sendity\Audit\Stores\JsonAuditStore;
use Sendity\Core\Config;
use Sendity\Core\Providers\ServiceProvider;

class AuditServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Audit Store
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            AuditStoreInterface::class,
            function ($container) {

                return new JsonAuditStore(
                    $container->get(Config::class)
                );

            }
        );
    }


    public function boot(): void
    {
        //
    }
}