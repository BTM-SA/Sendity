<div align="center"><img src="https://btm-sa.co.za/F4STMAIL/Logo.png" alt="Logo" width="400px">
</div>  


# Architecture

## Overview

Sendity is a lightweight, framework-first platform designed to provide a solid foundation for building modern PHP applications. The framework emphasizes simplicity, explicit design, modular components, and predictable application flow.

Rather than relying on hidden conventions or "magic," Sendity favors clear architecture where each component has a single responsibility and can be understood independently.

---

# Design Principles

Every part of Sendity is built around the following principles:

* **Clarity over cleverness** – Code should be easy to read, understand, and maintain.
* **Single Responsibility** – Every component should perform one job well.
* **Explicit over implicit** – Framework behavior should be predictable rather than hidden.
* **Framework before features** – Build strong foundations before application-specific functionality.
* **Testability** – Every component should be independently testable.
* **Extensibility** – New features should integrate with existing architecture without requiring major changes.

---

# Core Components

## Application

The central entry point of the framework.

It coordinates the complete application lifecycle by executing middleware, dispatching routes, handling exceptions, and managing the request-response flow.

---

## Container

The Dependency Injection Container is responsible for creating and resolving application objects.

It supports automatic dependency resolution using reflection while allowing services to be registered as bindings or singletons.

---

## Configuration

Provides centralized access to application configuration.

Configuration is loaded from the `config/` directory and made available throughout the framework via the service container.

---

## Router

Matches incoming HTTP requests to controllers or closures and dispatches the appropriate action.

The router is responsible only for routing and remains independent of business logic.

---

## Pipeline

Executes middleware in sequence before passing control to the router.

This allows features such as logging, authentication, rate limiting, and request filtering to be added without modifying application code.

---

## Request

Represents the incoming HTTP request and provides access to request data such as the HTTP method, URI, query parameters, headers, and request body.

---

## Response

Represents the outgoing HTTP response returned to the client.

The Response component provides a consistent mechanism for returning HTML, JSON, redirects, and other response types.

---

## Middleware

Middleware intercepts requests before they reach the router.

Each middleware performs a single task before passing execution to the next middleware in the pipeline.

---

## Controllers

Controllers contain application-specific request handling logic.

They receive requests from the router and return responses without needing to manage framework infrastructure.

---

## Services

Services encapsulate reusable business logic that can be shared across controllers and other framework components.

---

## Logger

The logging service provides centralized application logging.

Different log levels are supported to distinguish informational messages, warnings, and errors while maintaining a consistent logging format.

---

## Exception Handler

The Exception Handler provides centralized error management across the framework.

Its responsibilities include:

* Reporting exceptions to the logging system.
* Generating unique error reference identifiers.
* Rendering user-friendly error responses.
* Preventing raw PHP errors from being exposed to end users.

By centralizing exception handling, Sendity ensures that application failures are logged consistently while presenting safe and predictable responses to users.

---

# Application Lifecycle

Every HTTP request follows the same predictable execution path:

```text
Browser
    │
    ▼
Application
    │
    ▼
Pipeline
    │
    ▼
Middleware
    │
    ▼
Router
    │
    ▼
Controller
    │
    ▼
Response
    │
    ▼
Browser
```

If an uncaught exception occurs at any point during execution, control is transferred to the Exception Handler, which reports the error and generates an appropriate response.

---

# Architectural Goals

The long-term goal of Sendity is to provide a reusable PHP framework capable of supporting multiple applications.

The framework remains independent of application-specific functionality such as SMTP, IMAP, tracking, or mailbox management. These features are intended to be built as higher-level components on top of the framework.

This separation allows Sendity to evolve into a flexible platform suitable for building not only mail systems, but also APIs, administrative tools, and other web applications while maintaining a clean, modular architecture.
