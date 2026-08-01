# Architecture Decision Record

### ADR-0010: Container-Based Event Listener Resolution

> **Status:** Accepted
> **Date:** 2026-08-01

---


## Context

Sendity uses an event-driven architecture where framework events notify registered listeners.

As the framework grows, listeners require access to framework services such as:

- audit managers
- logging services
- configuration
- application services

Creating listener instances directly inside the event system would bypass the dependency container and make listeners harder to extend.

---

## Problem

The event dispatcher requires a consistent mechanism for creating listener instances.

Direct listener instantiation would create several problems:

- listeners could not receive constructor dependencies
- services would be created outside the container lifecycle
- singleton bindings would be ignored
- framework extensions would become harder to maintain

---

## Decision

Event listeners are resolved through the application container.

The `EventDispatcher` receives the listener class name and resolves the listener instance using the container before execution.

The resolution flow is:

```text
EventDispatcher
        |
        v
Container::get()
        |
        v
Listener Instance
        |
        v
handle(EventInterface)
```

All event listeners must implement:

```php
interface ListenerInterface
{
    public function handle(EventInterface $event): void;
}
```

The container is responsible for:

- resolving listener dependencies
- respecting service bindings
- managing listener lifecycle where applicable

---

## Reasoning

Using the container as the listener resolver keeps event handling consistent with the rest of Sendity's architecture.

Benefits:

- Dependency injection support
- Centralized object creation
- Consistent service lifecycle
- Easier package development
- Cleaner event infrastructure

---

## Consequences

### Positive

- Listeners remain simple and focused.
- Dependencies are injected automatically.
- Event infrastructure remains independent from listener implementation details.
- Third-party packages can register listeners using the same mechanism.

### Trade-offs

- Listeners must be registered as container-resolvable services.
- The container becomes a required dependency of the event system.

---

## Related Decisions

- ADR-0001: Framework Development Principles
- ADR-0002: Container Self Binding
- ADR-0003: Service Provider Lifecycle
- ADR-0004: ProviderLoader Architecture
- ADR-0009: Message Lifecycle Tracking and Audit Persistence
