# Architecture Decision Record

### ADR-0012: Isolate Event Listener Failures From Core Operations

> **Status:** Accepted  
> **Date:** 2026-08-01

---

## Context

Sendity uses an event-driven architecture where framework events notify registered listeners.

Events are dispatched after important framework operations, including mail delivery lifecycle changes.

Examples include:

- Mail sending notifications
- Successful delivery notifications
- Failure notifications
- Audit processing
- Logging
- Future integrations

During development, it was discovered that listener failures could affect the result of the original operation.

Example:

```text
SMTP Transport
       |
       v
   Mail Sent
       |
       v
 MailSent Event
       |
       v
 Listener Failure
       |
       v
 Operation incorrectly marked as failed
```

A listener failure is unrelated to the success or failure of the primary operation.

---

## Problem

Event listeners are observers.

They should not be able to change the outcome of the operation that triggered the event.

Without isolation:

- logging failures could break mail delivery
- audit failures could mark successful messages as failed
- third-party listeners could affect framework behaviour
- one listener failure could prevent other listeners from executing

The event system requires a clear separation between:

- core operations
- event observers

---

## Decision

The `EventDispatcher` isolates listener execution.

Each listener is executed independently.

If a listener throws an exception:

- the exception is caught by the dispatcher
- the failure is logged
- remaining listeners continue executing
- the original operation result remains unchanged

The event flow becomes:

```text
Core Operation
       |
       v
Event Dispatcher
       |
       +----------------+
       |                |
       v                v
 Listener A        Listener B
       |                |
    Success          Failure
                         |
                         v
                       Logger
```

The dispatcher remains responsible for event delivery, while listeners remain responsible for their own work.

---

## Reasoning

Event listeners represent secondary behaviour.

The success of the primary operation should not depend on optional observers.

For example:

A mail message successfully delivered through SMTP should remain successful even if:

- logging fails
- analytics fail
- auditing fails
- external integrations fail

This creates a more reliable and extensible framework.

---

## Implementation

Listener execution is wrapped inside the `EventDispatcher`.

Example:

```php
foreach ($listeners as $listener) {

    try {

        $instance = $this->container->get($listener);

        $instance->handle($event);

    } catch (Throwable $e) {

        Logger::error(
            sprintf(
                'Event listener failed [%s]: %s',
                $listener,
                $e->getMessage()
            )
        );
    }
}
```

---

## Consequences

### Positive

- Core operations remain reliable.
- Listener failures cannot create false failures.
- Multiple listeners can execute independently.
- Third-party integrations become safer.
- Event-driven architecture becomes more resilient.

### Trade-offs

- Listener failures require monitoring through logs.
- Some failures may require additional retry or alerting systems in the future.

---

## Related Decisions

- ADR-0004: ProviderLoader Architecture
- ADR-0009: Message Lifecycle Tracking and Audit Persistence
- ADR-0010: Container-Based Event Listener Resolution
- ADR-0011: Introduce Mail Event Base Class