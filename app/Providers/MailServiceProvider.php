<?php

declare(strict_types=1);

namespace Sendity\Providers;

use Sendity\Core\Providers\ServiceProvider;
use Sendity\Mail\MailerInterface;
use Sendity\Mail\SMTP\SmtpTransport;
use Sendity\Mail\Contracts\MailboxInterface;
use Sendity\Mail\IMAP\ImapClient;

class MailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(MailerInterface::class, function ($container) {
            return new SmtpTransport(
                $container->get(\Sendity\Core\Config::class),
                $container->get(\Sendity\Core\Events\EventDispatcher::class)
            );
        });
        $this->container->singleton(MailboxInterface::class, function ($container) {
            return new ImapClient($container->get(\Sendity\Core\Config::class));
        });
    }

    public function boot(): void
    {
        //
    }
}
