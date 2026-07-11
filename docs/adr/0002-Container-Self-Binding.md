<div align="center"><img src="https://btm-sa.co.za/F4STMAIL/Logo.png" alt="Sendity_Logo" width="400">
</div>


# Architecture Decision Record

### ADR-0002: Container Self Binding

> **Status:** Accepted <br>
> **Date:** 2026-07-11
---



# Context

Sendity uses a dependency injection container to manage framework services and their dependencies.

During development, an issue was discovered where different parts of the application were receiving different Container instances.

This caused services that should have been shared, such as the Router, to lose their registered state.

The result was that routes were successfully registered during bootstrap, but the Router used during request handling contained no routes.

---

# Problem

The application lifecycle depended on a shared Container instance.

However, because the Container itself was not registered as a shared service, dependency resolution could create separate Container objects.

This created isolated application states.

Example:

```
Bootstrap Container
        |
        └── Router with registered routes


Application Container
        |
        └── Different Router with no routes
```

---

# Decision

The Container will register itself as a singleton within the application lifecycle.

All framework components must receive the same Container instance.

The Container becomes the source of truth for dependency resolution.

---

# Reasoning

A framework container manages the lifecycle of all shared services.

If the container itself is not shared, the framework cannot guarantee:

* Singleton behavior
* Shared service state
* Consistent dependency resolution

By making the Container a singleton, all framework components operate within the same application context.

---

# Consequences

## Positive

* Services share the same application lifecycle.
* Singleton services behave correctly.
* Providers, loaders, and the application resolve dependencies consistently.
* Debugging becomes easier because object identity is predictable.

## Trade-offs

* The container becomes a central framework service.
* Care must be taken to avoid excessive dependence on the container from application code.

---

# Related Decisions

* ADR-0001: Framework Development Principles
* ADR-0003: Service Provider Lifecycle
* ADR-0004: ProviderLoader Architecture
