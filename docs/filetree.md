```
    .
    ├── app
    │   ├── Audit
    │   │   ├── AuditManager.php
    │   │   ├── AuditRecord.php
    │   │   ├── Contracts
    │   │   │   └── AuditStoreInterface.php
    │   │   └── Stores
    │   │       └── JsonAuditStore.php
    │   ├── Controllers
    │   │   └── HomeController.php
    │   ├── Core
    │   │   ├── Application.php
    │   │   ├── Config.php
    │   │   ├── Container.php
    │   │   ├── Environment.php
    │   │   ├── Events
    │   │   │   ├── Contracts
    │   │   │   │   ├── EventInterface.php
    │   │   │   │   └── ListenerInterface.php
    │   │   │   └── EventDispatcher.php
    │   │   ├── Exceptions
    │   │   │   └── ExceptionHandler.php
    │   │   ├── Pipeline.php
    │   │   └── Providers
    │   │       ├── ProviderLoader.php
    │   │       ├── RoutingServiceProvider.php
    │   │       └── ServiceProvider.php
    │   ├── Events
    │   │   ├── MailEvent.php
    │   │   ├── MailFailed.php
    │   │   ├── MailSending.php
    │   │   └── MailSent.php
    │   ├── Http
    │   │   ├── Contracts
    │   │   │   └── MiddlewareInterface.php
    │   │   ├── Middleware
    │   │   │   └── LoggerMiddleware.php
    │   │   ├── Request.php
    │   │   ├── Response.php
    │   │   └── Router.php
    │   ├── Listeners
    │   │   ├── AuditListener.php
    │   │   ├── LogMailSent.php
    │   │   └── StoreMailAudit.php
    │   ├── Mail
    │   │   ├── Address.php
    │   │   ├── Attachment.php
    │   │   ├── Contracts
    │   │   │   ├── MailboxInterface.php
    │   │   │   └── MailerInterface.php
    │   │   ├── DeliveryManager.php
    │   │   ├── Drivers
    │   │   │   ├── IMAP
    │   │   │   │   └── ImapMailbox.php
    │   │   │   └── SMTP
    │   │   │       └── SmtpTransport.php
    │   │   ├── Enums
    │   │   │   └── MessageStatus.php
    │   │   ├── Exceptions
    │   │   │   ├── AuthenticationException.php
    │   │   │   ├── MailboxException.php
    │   │   │   ├── MailException.php
    │   │   │   └── TransportException.php
    │   │   ├── LifecycleEvent.php
    │   │   ├── MailboxDiscovery.php
    │   │   ├── MailboxManager.php
    │   │   ├── MailLifecycle.php
    │   │   ├── MailManager.php
    │   │   ├── MailMessage.php
    │   │   ├── MailTransportManager.php
    │   │   ├── MessageIdGenerator.php
    │   │   └── Retry
    │   ├── Providers
    │   │   ├── AppServiceProvider.php
    │   │   ├── AuditServiceProvider.php
    │   │   ├── EventServiceProvider.php
    │   │   ├── MailServiceProvider.php
    │   │   ├── QueueServiceProvider.php
    │   │   └── RoutingServiceProvider.php
    │   ├── Queue
    │   │   ├── Contracts
    │   │   │   ├── JobInterface.php
    │   │   │   ├── QueueDriverInterface.php
    │   │   │   ├── QueueInterface.php
    │   │   │   └── QueueStorageInterface.php
    │   │   ├── Drivers
    │   │   │   ├── File
    │   │   │   │   └── FileQueueDriver.php
    │   │   │   └── Sync
    │   │   │       └── SyncQueueDriver.php
    │   │   ├── JobEnvelope.php
    │   │   ├── Jobs
    │   │   │   └── TestJob.php
    │   │   ├── QueueDriverManager.php
    │   │   ├── QueueManager.php
    │   │   ├── QueueStorageManager.php
    │   │   ├── QueueWorker.php
    │   │   ├── Retry
    │   │   │   └── RetryPolicy.php
    │   │   └── Storage
    │   │       └── FileQueueStorage.php
    │   ├── Routing
    │   │   └── RouteLoader.php
    │   ├── Services
    │   │   └── Logger.php
    │   └── Support
    │       └── helpers.php
    ├── bootstrap
    │   ├── app.php
    │   └── mail.php
    ├── composer.json
    ├── composer.lock
    ├── config
    │   ├── app.php
    │   ├── audit.php
    │   ├── mail.php
    │   ├── providers.php
    │   └── queue.php
    ├── docs
    │   ├── architecture
    │   │   ├── 01-framework.md
    │   │   ├── 02-domain.md
    │   │   ├── 03-queue.md
    │   │   └── adr
    │   │       ├── 0001-Framework-Development-Principles.md
    │   │       ├── 0002-Container-Self-Binding.md
    │   │       ├── 0003-Service-Provider-Lifecycle.md
    │   │       ├── 0004-ProviderLoader-Architecture.md
    │   │       ├── 0005-Sendity-Framework-Boundary.md
    │   │       ├── 0006-Separation-of-Framework-and-Application-Providers.md
    │   │       ├── 0007-Mail-Transport-Abstraction.md
    │   │       ├── 0008-Message-Identity.md
    │   │       ├── 0009-Introduce-Message-Lifecycle-Tracking-and-Audit-Persistence.md
    │   │       ├── 0010-Container-Based-Event-Listener-Resolution.md
    │   │       ├── 0011-Mail-Event-Base-Class.md
    │   │       ├── 0012-Isolate-Event-Listener-Failures-From-Core-Operations.md
    │   │       ├── 0013-event-listener-failure-isolation.md
    │   │       └── 0014-
    │   ├── filetree.md
    │   ├── Northstar.md
    │   └── workflows
    │       ├── 01-purpose.md
    │       ├── 02-identity.md
    │       └── 03-send-email.md
    ├── public
    │   └── index.php
    ├── README.md
    ├── routes
    │   └── web.php
    ├── storage
    │   ├── audit
    │   ├── Logs
    │   │   └── app.log
    │   ├── queue
    │   └── queue-test.txt
    └── vendor

```