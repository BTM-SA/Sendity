<div align="center"><img src="https://btm-sa.co.za/F4STMAIL/Logo.png" alt="Sendity_Logo" width="400">
</div>


# Architecture Decision Record

### ADR-0001: Framework Development Principles

> **Status:** Accepted <br>
> **Date:** 2026-07-11
---

# Context

As Sendity grows, architectural consistency becomes increasingly important.

Without agreed principles, different parts of the framework may evolve in different directions, making the codebase harder to understand, maintain, and extend.

This ADR establishes the engineering principles that guide all future architectural decisions.

---

# Decision

The Sendity framework will follow the principles below.

## 1. Clarity Over Cleverness

Framework code should be easy to read and understand.

If two solutions provide similar functionality, the simpler and more explicit design should be preferred.

Code should explain itself whenever possible.

---

## 2. Explicit Dependencies

Classes should receive their dependencies through constructor injection.

Hidden dependencies, global state, and implicit behavior should be avoided.

Every class should clearly express what it requires to operate.

---

## 3. Single Responsibility

Each class should have one well-defined responsibility.

Examples:

* Router matches and dispatches routes.
* RouteLoader loads route definitions.
* ProviderLoader loads service providers.
* Application coordinates the request lifecycle.

When responsibilities begin to overlap, they should be separated into dedicated components.

---

## 4. The Container Is the Source of Truth

Shared framework services must be resolved through the application container.

The container manages object lifecycles and ensures shared services remain consistent throughout the application.

Framework services should not create independent instances of other shared framework services.

---

## 5. Providers Register Services

Service providers exist to register and bootstrap framework services.

They should not contain business logic.

Complex behavior should be implemented inside dedicated service classes.

---

## 6. Separation of Concerns

Framework responsibilities should remain clearly separated.

Examples:

* Bootstrapping prepares the application.
* Providers register services.
* Loaders discover resources.
* Routers dispatch requests.
* Controllers execute application logic.

Each layer should remain focused on its own responsibility.

---

## 7. Incremental Development

The framework will evolve through small, well-tested improvements.

Large architectural rewrites should be avoided whenever practical.

Each completed feature should leave the framework in a better state than before.

---

## 8. Documentation Is Part of Development

Documentation is considered part of the implementation.

Major features should include:

* Documentation
* Architectural notes
* Usage examples where appropriate

Documentation should evolve alongside the framework.

---

## 9. Architectural Decisions Are Recorded

Every significant architectural decision should be documented as an Architecture Decision Record (ADR).

Each ADR should describe:

* Problem
* Decision
* Reasoning
* Consequences

Architectural knowledge should never exist only in commit history or developer memory.

---

## 10. Developer Experience Matters

Internal architecture should support an enjoyable developer experience.

Public APIs should be expressive, predictable, and easy to understand without hiding how the framework operates internally.

Developer convenience should never come at the expense of architectural clarity.

---

# Consequences

Following these principles should result in a framework that is:

* Consistent
* Understandable
* Maintainable
* Extensible
* Educational

These principles serve as the foundation for all future architectural decisions within Sendity.
