# Architecture Decision Record

### ADR-0007: Mail Transport Abstraction

> **Status:** Accepted
> **Date:** 2026-07-26

---

## Context

As Sendity's mail capabilities expanded, the application moved beyond simple email delivery into a broader mail subsystem.

The framework needs to support different mail-related capabilities, including:

* Sending messages
* Managing mailboxes
* Storing sent messages
* Future mailbox operations such as folders, searching, and message retrieval

Early implementations interacted directly with transport-specific details. This created a risk that application code would become coupled to specific protocols such as SMTP and IMAP.

Sendity requires a clear separation between mail capabilities and the underlying technologies used to provide those capabilities.

---

## Problem

Mail protocols define mechanisms, not application concepts.

SMTP provides message delivery.

IMAP provides mailbox access.

However, application code should not need to understand protocol-specific operations.

Without an abstraction layer, future changes such as supporting additional mail providers or replacing protocol implementations would require changes throughout the application.

Example:

```text
Application

    |
    ▼

SMTP implementation details

    |
    ▼

Mail server
```

This creates unnecessary coupling.

---

## Decision

Sendity will define mail capabilities through framework-owned contracts.

The mail subsystem will separate:

* Mail capabilities
* Transport implementations
* External protocols

The architecture will use:

```text
MailerInterface

        |

        ▼

SmtpTransport

        |

        ▼

SMTP
```

and:

```text
MailboxInterface

        |

        ▼

Mailbox Driver

        |

        ├── NativeImapClient

        ├── PhpImapClient

        └── Future Drivers
```

The active mailbox driver is selected by the framework through configuration.

Applications always depend on `MailboxInterface` and remain independent of the underlying implementation.

The framework owns the interfaces and services.

External protocols, libraries, and native extensions remain implementation details behind those services.

---

## Reasoning

Sendity should expose capabilities rather than protocols.

Applications should be able to express intent:

```php
$mailer->send($message);

$mailbox->appendSent($mime);
```

without needing knowledge of:

```php
imap_open();

imap_append();

SMTP commands;

MIME transport details;
```

This approach provides:

* Cleaner application code
* Replaceable implementations
* Better testing capabilities
* Reduced coupling to external technologies
* Simplified installation by allowing alternative implementations where native extensions are unavailable
* Clear architectural boundaries

---

## Consequences

### Positive

* Mail functionality is separated from protocol implementation.
* SMTP and mailbox implementations can evolve independently.
* Future providers can be added without changing application code.

Examples:

```text
MailboxInterface

    ├── NativeImapClient

    ├── PhpImapClient

    ├── GmailMailbox

    ├── GraphMailbox

    └── Community Drivers
```

* Different mailbox drivers may coexist behind the same framework contract.
* The framework can support native extensions where available while also supporting pure PHP implementations.
* The mail subsystem follows the same architectural principles as routing, events, and service providers.

### Trade-offs

* Additional abstraction layers must be maintained.
* Multiple implementations require consistent behaviour across drivers.
* Developers must understand Sendity contracts before working directly with implementations.

---

## Installation Philosophy

Framework abstractions exist not only to isolate protocol implementations, but also to minimise installation complexity.

Where multiple implementations provide equivalent capabilities, Sendity should favour implementations that reduce operating system-specific dependencies while preserving the same public framework contract.

Applications should never require changes when switching between mailbox driver implementations.

Native extensions remain supported where appropriate, but they should be optional rather than mandatory wherever practical.

---

## Alternatives Considered

### Expose SMTP and IMAP directly

Rejected because application code would become coupled to specific protocols.

### Build a complete mail protocol implementation

Rejected because Sendity's responsibility is providing a clear framework API, not reimplementing established internet protocols.

### Require native PHP extensions

Rejected because platform-specific dependencies increase installation complexity and reduce portability.

Native extensions remain valid driver implementations but should not become a framework requirement where equivalent alternatives exist.

### Use transport implementations directly throughout the application

Rejected because it would make future changes more difficult and spread protocol-specific knowledge across the codebase.

---

## Related Decisions

* ADR-0001: Framework Development Principles
* ADR-0005: Sendity and Framework Boundary
* ADR-0006: Separation of Framework and Application Providers

---

## Summary

Sendity owns the mail abstraction layer.

Protocols such as SMTP and IMAP provide the underlying communication mechanisms, but applications interact only with framework-owned contracts.

The framework exposes consistent mail capabilities while keeping implementation details isolated, replaceable, and configurable.

This architecture allows Sendity to support multiple mailbox technologies and transport implementations without requiring changes to application code or increasing installation complexity.
