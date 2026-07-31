<?php

use Sendity\Providers\AppServiceProvider;
use Sendity\Providers\RoutingServiceProvider;
use Sendity\Providers\EventServiceProvider;
use Sendity\Providers\MailServiceProvider;
use Sendity\Providers\AuditServiceProvider;

return [

    AppServiceProvider::class,

    RoutingServiceProvider::class,

    EventServiceProvider::class,

    MailServiceProvider::class,
    
    AuditServiceProvider::class,


];