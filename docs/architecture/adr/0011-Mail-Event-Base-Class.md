# Architecture Decision Record

### ADR-0011: Introduce Mail Event Base Class

> **Status:** Accepted
> **Date:** 2026-08-01

---


## Context

Sendity uses an event-driven architecture for communication lifecycle notifications.

Mail-related events are dispatched during important stages of message processing, including:

- sending preparation
- successful delivery
- delivery failure

Before this decision, each mail event stored its own reference to the `MailMessage` instance.

The events shared a common purpose but duplicated the same structure.

Before:

```php
class MailSent implements EventInterface
{
    public function __construct(
        public readonly MailMessage $message
    ) {
    }
}
```

```php
class MailSending implements EventInterface
{
    public function __construct(
        public readonly MailMessage $message
    ) {
    }
}
```

This duplication would continue as more mail events were introduced.

---

## Problem

As Sendity grows, additional mail lifecycle events may be required, such as:

- queued messages
- retries
- deferred delivery
- cancellation
- delivery processing events

Without a shared abstraction, every mail event would need to redefine access to the associated message.

This creates:

- duplicated code
- inconsistent event structures
- harder listener development
- reduced flexibility for future changes

---

## Decision

Introduce a shared `MailEvent` base class.

All mail lifecycle events extend this base class.

The structure becomes:

```text
              MailEvent
                  |
        +---------+---------+
        |         |         |
        v         v         v
 MailSending  MailSent  MailFailed
```

`MailEvent` owns access to the related `MailMessage`.

The message is accessed through:

```php
$event->message();
```

rather than exposing the internal property directly.

Example:

```php
abstract class MailEvent implements EventInterface
{
    public function __construct(
        protected readonly MailMessage $message
    ) {
    }

    public function message(): MailMessage
    {
        return $this->message;
    }
}
```

Specialised events only contain additional information specific to their purpose.

For example, `MailFailed` additionally stores the failure exception.

---

## Reasoning

A common mail event abstraction creates a consistent event contract.

Benefits include:

- reduced duplication
- consistent message access
- easier listener development
- improved framework extensibility
- simpler introduction of future mail events

Listeners can depend on the `MailEvent` contract rather than individual event implementations.

---

## Consequences

### Positive

- Mail events share a common structure.
- Future mail events can be added more easily.
- Event listeners have a consistent API.
- Internal event implementation details are hidden.

### Trade-offs

- Introduces an additional abstraction layer.
- Developers must understand the mail event hierarchy.

---

## Related Decisions

- ADR-0001: Framework Development Principles
- ADR-0004: ProviderLoader Architecture
- ADR-0009: Message Lifecycle Tracking and Audit Persistence
- ADR-0010: Container-Based Event Listener Resolution