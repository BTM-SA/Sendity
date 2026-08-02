<?php

declare(strict_types=1);

namespace Sendity\Providers;

use Sendity\Core\Events\EventDispatcher;
use Sendity\Core\Providers\ServiceProvider;

use Sendity\Events\MailFailed;
use Sendity\Events\MailSent;

use Sendity\Listeners\LogMailSent;
use Sendity\Listeners\AuditListener;


class EventServiceProvider extends ServiceProvider
{
    /**
     * Event => Listeners
     *
     * @var array<class-string, array<class-string>>
     */
    protected array $listen = [

    MailSent::class => [
        LogMailSent::class,
        AuditListener::class,
    ],

    MailFailed::class => [
        AuditListener::class,
    ],

];
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $dispatcher = $this->container->get(
            EventDispatcher::class
        );

        foreach ($this->listen as $event => $listeners) {

            foreach ($listeners as $listener) {

                $dispatcher->listen(
                    $event,
                    $listener
                );
            }
        }
    }
}