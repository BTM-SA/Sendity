
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
    │   ├── Domain
    │   │   ├── Conversation
    │   │   │   └── Conversation.php
    │   │   ├── Identity
    │   │   │   └── identity.php
    │   │   ├── Mailbox
    │   │   │   └── Mailbox.php
    │   │   └── Message
    │   │       └── Message.php
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
    │   │   └── LogMailSent.php
    │   ├── Mail
    │   │   ├── Address.php
    │   │   ├── Attachment.php
    │   │   ├── Contracts
    │   │   │   ├── DeliveryTransportInterface.php
    │   │   │   ├── MailboxInterface.php
    │   │   │   └── MailerInterface.php
    │   │   ├── DeliveryContext.php
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
    │   │   ├── Retry
    │   │   └── SendEmail.php
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
    │   │       ├── 0013-Event-Listener-Failure-Isolation.md
    │   │       └── 0014-Queue-Architecture.md
    │   ├── filetree.md
    │   ├── northstar.md
    │   ├── product
    │   │   ├── 01-credential-health.md
    │   │   └── 02-email-experience.md
    │   ├── ui
    │   │   └── ui-shell.md
    │   └── workflows
    │       ├── 01-purpose.md
    │       ├── 02-identity.md
    │       ├── 03-send-email.md
    │       ├── 04-receiving-email.md
    │       ├── 05-conversations.md
    │       ├── 06-document-protection.md
    │       ├── 07-templates.md
    │       ├── 08-communication-insights.md
    │       └── 09-security-and-identity.md
    ├── images
    │   └── Sendity-Logo.png
    ├── public
    │   └── index.php
    ├── README.md
    ├── routes
    │   └── web.php
    ├── storage
    │   ├── audit
    │   │   └── snd_cc7da15c3c0d320cc2254232d7ca53c1.json
    │   ├── Logs
    │   │   └── app.log
    │   ├── queue
    │   └── queue-test.txt
    └── vendor