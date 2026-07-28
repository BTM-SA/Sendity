<?php

declare(strict_types=1);

namespace Sendity\Providers;

use Sendity\Core\Config;
use Sendity\Core\Events\EventDispatcher;
use Sendity\Core\Providers\ServiceProvider;
use Sendity\Mail\MailerInterface;
use Sendity\Mail\Drivers\SMTP\SmtpTransport;
use Sendity\Mail\Contracts\MailboxInterface;
use Sendity\Mail\Drivers\IMAP\NativeImapClient;
use Sendity\Mail\Drivers\IMAP\PhpImapClient;

class MailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(MailerInterface::class, function ($container) {
            return new SmtpTransport($container->get(Config::class), $container->get(EventDispatcher::class));
        });

        $this->container->singleton(MailboxInterface::class, function ($container) {
            $config = $container->get(Config::class);

            $driver = $config->get("mail.mailbox.driver");

            return match ($driver) {
                "native" => new NativeImapClient($config),

                "php" => new PhpImapClient($config),

                default => throw new \RuntimeException("Unsupported mailbox driver: {$driver}"),
            };
        });
    }

    public function boot(): void
    {
        //
    }
}
