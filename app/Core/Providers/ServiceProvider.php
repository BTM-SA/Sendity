<?php

namespace Sendity\Core\Providers;

use Sendity\Core\Container;

abstract class ServiceProvider
{
    public function __construct(
        protected Container $container
    ) {
    }

    /**
     * Register services into the container.
     */
    public function register(): void
    {
    }

    /**
     * Boot services after registration.
     */
    public function boot(): void
    {
    }
}