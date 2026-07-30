<?php

declare(strict_types=1);

namespace Sendity\Providers;

use Sendity\Core\Config;
use Sendity\Core\Events\EventDispatcher;
use Sendity\Core\Providers\ServiceProvider;
use Sendity\Mail\Contracts\MailboxInterface;
use Sendity\Mail\Drivers\IMAP\ImapMailbox;
use Sendity\Mail\Drivers\SMTP\SmtpTransport;
use Sendity\Mail\MailerInterface;
use Sendity\Mail\MailManager;
use Sendity\Mail\MailTransportManager;
use Sendity\Mail\MailboxManager;
use Sendity\Mail\MessageIdGenerator;

class MailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Mail Transport Manager
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            MailTransportManager::class,
            function ($container) {

                return new MailTransportManager(
                    $container->get(Config::class),
                    $container
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Mailbox Manager
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            MailboxManager::class,
            function ($container) {

                return new MailboxManager(
                    $container->get(Config::class),
                    $container
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Mail Manager
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            MailManager::class,
            function ($container) {

                return new MailManager(
                    $container->get(MailTransportManager::class),
                    $container->get(MailboxManager::class)
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Message ID Generator
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            MessageIdGenerator::class,
            function () {

                return new MessageIdGenerator();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | SMTP Transport
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            SmtpTransport::class,
            function ($container) {

                return new SmtpTransport(
                    $container->get(Config::class),
                    $container->get(EventDispatcher::class),
                    $container->get(MailboxInterface::class)
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Default Mailer
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            MailerInterface::class,
            function ($container) {

                return $container
                    ->get(MailManager::class)
                    ->transport()
                    ->driver();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | IMAP Mailbox
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            MailboxInterface::class,
            function ($container) {

                return new ImapMailbox(
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