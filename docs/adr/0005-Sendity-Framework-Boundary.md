<div align="center"><img src="https://btm-sa.co.za/F4STMAIL/Logo.png" alt="Sendity_Logo" width="400">
</div>


# ADR-0005: Sendity and Framework Boundary

## Status

Accepted

## Date

2026-07-14

## Context

During the development of Sendity, the application framework and the email application evolved together.

The framework provides important capabilities such as:

* application bootstrapping,
* dependency management,
* service registration,
* routing,
* lifecycle management,
* and reusable infrastructure components.

As the framework matured, there was a risk that development effort could shift from building Sendity into building a general-purpose framework without a clear application need.

Sendity is not being created as a framework project. The framework exists because the Sendity application requires a structured foundation.

## Decision

Sendity is the primary product.

The framework exists to support Sendity and provide reusable application infrastructure where that infrastructure creates real value.

Framework development must be guided by application requirements rather than existing independently as the primary goal.

New framework abstractions should only be introduced when they:

* solve a real application problem,
* improve maintainability,
* support future extensibility,
* or provide clear value to applications built on the framework.

The success of the framework is measured by how effectively it enables Sendity, not by the number of framework features it contains.

## Consequences

### Positive

* Maintains focus on the Sendity product vision.
* Reduces unnecessary abstraction and complexity.
* Encourages practical, purpose-driven architecture.
* Allows framework components to mature naturally through real usage.

### Negative

* Some potentially useful framework features may be postponed until a concrete need exists.
* The framework may grow more slowly than a framework-first project.

## Notes

The framework and application should remain closely aligned while maintaining clear boundaries.

The framework provides the foundation.

Sendity provides the purpose.

The framework serves the application.
