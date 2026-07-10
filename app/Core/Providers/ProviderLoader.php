<?php

namespace Sendity\Core\Providers;

use Sendity\Core\Container;

class ProviderLoader
{
    public function __construct(
        protected Container $container
    ) {
    }

    public function load(array $providers): void
{
   $providerInstances = [];

    foreach ($providers as $provider) {
    $providerInstances[] = $this->container->get($provider);
}

foreach ($providerInstances as $provider) {
    $provider->register();
}

foreach ($providerInstances as $provider) {
    $provider->boot();
}
}
}