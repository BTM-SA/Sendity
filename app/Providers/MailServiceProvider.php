<?php

declare(strict_types=1);

namespace Sendity\Providers;

use Sendity\Core\Config;
use Sendity\Core\Events\EventDispatcher;
use Sendity\Core\Providers\ServiceProvider;
use Sendity\Mail\Contracts\MailboxInterface;
use Sendity\Mail\Drivers\IMAP\ImapClient;
use Sendity\Mail\Drivers\SMTP\SmtpTransport;
use Sendity\Mail\MailerInterface;

class MailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(
            MailerInterface::class,
            function ($container) {
                return new SmtpTransport(
                    $container->get(Config::class),
                    $container->get(EventDispatcher::class),
                    $container->get(MailboxInterface::class)
                );
            }
        );

        $this->container->singleton(
            MailboxInterface::class,
            function ($container) {
                return new ImapClient(
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