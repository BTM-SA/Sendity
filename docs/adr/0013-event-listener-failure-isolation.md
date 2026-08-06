# Architecture Decision Record

### ADR-0013: Event Listener Failure Isolation

> **Status:** Accepted  
> **Date:** 2026-08-02

---

## Context

Sendity uses an event-driven architecture where framework events notify registered listeners.

Listeners are responsible for secondary actions that happen after framework operations.

Examples include:

- logging
- audit persistence
- notifications
- external integrations
- analytics
- future package extensions

As event listeners are independent observers, their failures should not affect the primary operation that triggered the event.

During development, listener failures were tested against the mail lifecycle system.

Examples:

```text
MailSent Event

        |
        +--> LogMailSent
        |        |
        |        X Failed
        |
        +--> AuditListener
                 |
                 ✓ Completed
```

and:

```text
MailSent Event

        |
        +--> LogMailSent
        |        |
        |        ✓ Completed
        |
        +--> AuditListener
                 |
                 X Failed
```

Both scenarios confirmed that listeners can fail independently.

---

## Problem

Without listener isolation, event handlers could affect the result of core framework operations.

A failing listener could:

- mark a successful operation as failed
- prevent other listeners from executing
- interrupt framework workflows
- allow optional features to affect required functionality

Examples:

- A logging failure should not fail email delivery.
- An audit failure should not mark a message as undelivered.
- A third-party integration failure should not stop framework execution.

---

## Decision

The `EventDispatcher` isolates listener execution.

Each listener is executed independently inside its own error boundary.

If a listener throws an exception:

- the exception is caught by the dispatcher
- the failure is logged
- execution continues with remaining listeners
- the original operation result is preserved

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

 Success            Failure
                        |
                        v
                    Logger
```

The dispatcher is responsible for protecting the event pipeline.

Listeners remain responsible only for their own behaviour.

---

## Implementation

Listener execution is wrapped by the dispatcher:

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

## Reasoning

Events represent notifications, not required execution paths.

The system that creates the event must remain independent from the observers receiving it.

Separating listener failures from core operations provides:

- increased framework reliability
- safer package extensions
- predictable event behaviour
- improved fault tolerance

---

## Consequences

### Positive

- Core operations cannot be broken by observers.
- Multiple listeners can execute independently.
- Third-party listeners are safer.
- Optional features remain optional.
- Event infrastructure becomes more resilient.

### Trade-offs

- Listener failures require monitoring.
- Some listeners may require retry mechanisms in future versions.
- Silent failure must be avoided through proper logging.

---

## Related Decisions

- ADR-0004: ProviderLoader Architecture
- ADR-0009: Message Lifecycle Tracking and Audit Persistence
- ADR-0010: Container-Based Event Listener Resolution
- ADR-0011: Introduce Mail Event Base Class
- ADR-0012: Isolate Event Listener Failures From Core Operations