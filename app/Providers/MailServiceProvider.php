<?php

declare(strict_types=1);

namespace Sendity\Providers;

use Sendity\Audit\AuditManager;
use Sendity\Audit\Contracts\AuditStoreInterface;
use Sendity\Audit\Stores\JsonAuditStore;
use Sendity\Core\Config;
use Sendity\Core\Events\EventDispatcher;
use Sendity\Core\Providers\ServiceProvider;
use Sendity\Mail\Contracts\MailboxInterface;
use Sendity\Mail\Contracts\MailAuthenticatorInterface;
use Sendity\Mail\DeliveryManager;
use Sendity\Mail\Drivers\IMAP\ImapAuthenticator;
use Sendity\Mail\Drivers\IMAP\ImapMailbox;
use Sendity\Mail\Drivers\SMTP\SmtpTransport;
use Sendity\Mail\Contracts\MailerInterface;
use Sendity\Mail\MailManager;
use Sendity\Mail\MailTransportManager;
use Sendity\Mail\MailboxManager;
use Sendity\Mail\MessageIdGenerator;
use Sendity\Queue\QueueManager;


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
        | Delivery Manager
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            DeliveryManager::class,
            function ($container) {

                return new DeliveryManager(
                    $container->get(MailTransportManager::class)
                );

            }
        );


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


        /*
        |--------------------------------------------------------------------------
        | Audit Manager
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            AuditManager::class,
            function ($container) {

                return new AuditManager(
                    $container->get(AuditStoreInterface::class)
                );

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
        | Mail Manager
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            MailManager::class,
            function ($container) {

                return new MailManager(
                    $container->get(DeliveryManager::class),
                    $container->get(MailboxManager::class),
                    $container->get(QueueManager::class)
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

                return $container->get(
                    MailManager::class
                );

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


        /*
        |--------------------------------------------------------------------------
        | Mail Credential Authenticator
        |--------------------------------------------------------------------------
        */

        $this->container->singleton(
            MailAuthenticatorInterface::class,
            function ($container) {

                return new ImapAuthenticator(
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
