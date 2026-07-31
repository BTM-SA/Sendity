# Architecture Decision Record

### ADR-0009: Introduce Message Lifecycle Tracking and Audit Persistence

> **Status:** Accepted
> **Date:** 2026-07-31

---

## Context

Email delivery is not a single action.

A message moves through multiple stages during its lifetime, including creation, preparation, sending, successful delivery, and failure states.

Previously, Sendity only represented the act of sending a message. This limited visibility into what happened before and after transport execution.

As Sendity grows into a communication framework, messages require a reliable history of their lifecycle events.

The system also requires a way to persist these events so they can be inspected, debugged, and used by future features such as message history, delivery insights, and administration tools.

## Decision

Sendity introduces a message lifecycle system that records state transitions as lifecycle events.

Each `MailMessage` owns a `MailLifecycle` instance responsible for tracking its current state and event history.

Supported lifecycle states include:

- `CREATED`
- `QUEUED`
- `SENDING`
- `SENT`
- `FAILED`

Each lifecycle transition creates a `LifecycleEvent` containing:

- message status
- occurrence timestamp
- optional metadata

Example:

```json
{
    "status": "sent",
    "occurred_at": "2026-07-31T18:18:05+00:00",
    "metadata": {
        "transport": "smtp",
        "message_id": "snd_xxxxx"
    }
}
```

Lifecycle events are persisted through an audit abstraction.

The audit storage boundary is:

```text
AuditStoreInterface
        |
        |
JsonAuditStore
```

This allows audit storage implementations to change without affecting mail delivery.

## Reasoning

Tracking lifecycle events separately from transport implementation provides:

- better debugging capabilities
- message history
- transport visibility
- future retry support
- delivery insights
- framework extensibility

The lifecycle system does not determine how messages are delivered.

The transport layer remains responsible only for delivery.

The audit layer remains responsible only for persistence.

This maintains separation of concerns.

## Consequences

### Positive

- Every message has a traceable history.
- Delivery behaviour becomes observable.
- Future queue and retry systems can reuse lifecycle tracking.
- Audit storage can be replaced without changing mail logic.
- Framework users can build reporting and administration features.

### Negative

- Additional objects and events are created for each message.
- Storage decisions must be managed as the audit system grows.
- Lifecycle states must remain backward compatible.

## Implementation Details

Current lifecycle flow:

```text
MailMessage
      |
      v
MailLifecycle
      |
      v
LifecycleEvent[]
      |
      v
AuditStoreInterface
      |
      v
JsonAuditStore
```

Current SMTP lifecycle example:

```text
CREATED
   |
   v
SENDING
   |
   v
SENT
```

Lifecycle metadata currently includes:

- transport
- SMTP host
- SMTP port
- attempt number
- Sendity message identity

## Future Considerations

Possible future lifecycle states:

- `DELIVERED`
- `OPENED`
- `CLICKED`
- `BOUNCED`
- `RETRYING`
- `EXPIRED`

These should only be introduced when the underlying behaviour exists.

Lifecycle expansion should preserve the existing event model.