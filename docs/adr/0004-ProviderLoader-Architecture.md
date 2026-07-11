<div align="center"><img src="https://btm-sa.co.za/F4STMAIL/Logo.png" alt="Sendity_Logo" width="400">
</div>


# Architecture Decision Record

### ADR-0004: ProviderLoader Architecture

> **Status:** Accepted <br>
> **Date:** 2026-07-11

---


# Context

During early development, framework services were registered directly inside `bootstrap/app.php`.

As more services were added, the bootstrap file became responsible for both preparing the application and coordinating framework service registration.

This mixed application bootstrapping with framework initialization.

---

# Problem

The bootstrap file should prepare the application, not contain the logic for loading framework providers.

As the number of providers grows, manually loading and coordinating them inside the bootstrap process becomes difficult to maintain.

Without a dedicated loader, the provider lifecycle would become scattered throughout the application startup process.

---

# Decision

Introduce a dedicated `ProviderLoader` responsible for managing the complete provider lifecycle.

The `ProviderLoader` is responsible for:

* Creating provider instances
* Executing every provider's `register()` method
* Executing every provider's `boot()` method

The loading sequence is:

```text
Create Provider Instances
            │
            ▼
      register()
            │
            ▼
         boot()
```

The bootstrap process is responsible only for invoking the `ProviderLoader`.

---

# Reasoning

Separating provider loading from application bootstrapping creates a cleaner architecture.

Benefits include:

* Smaller bootstrap process
* Centralized provider lifecycle
* Predictable initialization order
* Easier maintenance as the framework grows
* Simpler integration of future providers and packages

The `ProviderLoader` becomes the single authority responsible for provider execution.

---

# Consequences

## Positive

* `bootstrap/app.php` remains focused on preparing the application.
* Providers follow a consistent lifecycle.
* New framework features can be introduced by simply registering additional providers.
* Third-party packages can integrate through the same provider mechanism.

## Trade-offs

* Introduces an additional framework component.
* Developers must understand the provider lifecycle when extending the framework.

---

# Related Decisions

* ADR-0001: Framework Development Principles
* ADR-0002: Container Self Binding
* ADR-0003: Service Provider Lifecycle
* ADR-0005: Route Facade
