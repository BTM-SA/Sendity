<div align="center"><img src="https://btm-sa.co.za/F4STMAIL/Logo.png" alt="Sendity_Logo" width="400">
</div>


# Architecture Decision Record

### ADR-0003: Service Provider Lifecycle

> **Status:** Accepted <br>
> **Date:** 2026-07-11
---


# Context

As Sendity grew, framework services needed a structured way to register themselves with the application container.

Early development placed more responsibility inside the bootstrap process, which made it harder to manage dependencies and separate framework concerns.

A provider-based system was introduced to allow framework components to register services independently.

---

# Problem

Framework services have two different responsibilities:

1. Registering themselves with the container.
2. Performing initialization after all services have been registered.

Without separating these responsibilities, services may attempt to use dependencies before those dependencies exist.

Example:

```text
Provider A

registers Service A


Provider B

needs Service A during startup
```

The framework needs a predictable order.

---

# Decision

Service providers will have two lifecycle methods:

## register()

Used only for registering services into the container.

Example:

```php
public function register(): void
{
    $this->container->singleton(
        Router::class,
        fn ($container) => new Router($container)
    );
}
```

## boot()

Used for actions that require already registered services.

Example:

```php
public function boot(): void
{
    $loader = $this->container->get(RouteLoader::class);

    $loader->loadWebRoutes();
}
```

The ProviderLoader executes these phases separately:

```text
Create providers

        ↓

register()

        ↓

boot()
```

---

# Reasoning

Separating registration and booting provides:

* Predictable dependency availability
* Cleaner service providers
* Better framework extensibility
* Easier package development

A provider can declare what services it provides without mixing that responsibility with startup behavior.

---

# Consequences

## Positive

* Framework initialization becomes predictable.
* Services can depend on other registered services.
* Providers remain small and focused.
* Third-party packages can integrate through providers.

## Trade-offs

* Developers must understand the difference between registration and booting.
* Some simple services may require more structure than a direct instantiation.

---

# Related Decisions

* ADR-0001: Framework Development Principles
* ADR-0002: Container Self Binding
* ADR-0004: ProviderLoader Architecture
