# Architecture Decision Record

### ADR-0006: Separation of Framework and Application Providers

> **Status:** Accepted <br>
> **Date:** 2026-07-23

---


## Context

As Sendity's service container and provider system evolved, service registration became the primary mechanism for configuring framework services.

During development it became apparent that two distinct categories of provider-related classes existed:

* **Framework provider infrastructure**, responsible for loading and managing providers.
* **Application service providers**, responsible for registering services and bootstrapping application functionality.

Initially, these responsibilities risked becoming mixed, making it less obvious which classes formed part of the framework itself and which were responsible for configuring it.

## Decision

Sendity separates provider infrastructure from provider implementations.

Framework infrastructure is located under:

```text
app/Core/Providers
```

This directory contains the components responsible for the provider system itself, including:

* `ServiceProvider`
* `ProviderLoader`

Application service providers are located under:

```text
app/Providers
```

Examples include:

* `AppServiceProvider`
* `RoutingServiceProvider`
* `EventServiceProvider`
* `MailServiceProvider`

All future service providers should be placed within `app/Providers`.

## Rationale

Separating provider infrastructure from provider implementations establishes a clear architectural boundary.

The **Core** namespace represents the framework engine and should contain only reusable framework components.

The **Providers** namespace represents the application's configuration layer, where services are registered, bootstrapped, and extended.

This separation improves maintainability by making responsibilities explicit, reducing coupling between framework internals and application configuration.

It also provides a predictable convention for future framework features such as database, cache, queue, filesystem, notification, and mail providers.

## Consequences

### Positive

* Clear separation between framework internals and application configuration.
* Consistent location for all service providers.
* Easier navigation of the codebase.
* Improved extensibility as additional providers are introduced.
* Aligns with conventions established by modern PHP frameworks while remaining framework-agnostic.

### Negative

* Provider-related classes now exist in two namespaces, requiring developers to understand the distinction between provider infrastructure and provider implementations.

## Alternatives Considered

### Place all provider classes under `app/Core/Providers`

Rejected because application-specific providers would become mixed with framework infrastructure, making ownership and responsibility less clear.

### Place `ProviderLoader` alongside application providers

Rejected because `ProviderLoader` is part of the framework runtime rather than application configuration and therefore belongs within the framework core.
