<div align="center"><img src="https://btm-sa.co.za/F4STMAIL/Logo.png" alt="Sendity_Logo" width="400">
</div>


# Sendity Framework

Sendity is a modular PHP framework built around clean architecture principles, dependency injection, service providers, and a structured application lifecycle.

The goal of Sendity is to provide a lightweight but extensible foundation for building modern PHP applications while keeping the framework understandable and maintainable.

---

# Current Features

## Dependency Injection Container

Sendity includes its own service container supporting:

* Service bindings
* Singleton services
* Automatic dependency resolution
* Shared application lifecycle management

The container manages framework dependencies and ensures services receive the correct application context.

---

## Service Provider Architecture

Framework services are organised through service providers.

Current providers include:

```
app/
└── Providers/
    ├── AppServiceProvider.php
    └── RoutingServiceProvider.php
```

Providers allow services to be registered and booted in a modular way.

The framework uses a ProviderLoader to manage the provider lifecycle:

```
ProviderLoader

    ↓

register()

    ↓

boot()
```

Framework services are now registered through the ProviderLoader, establishing the foundation for modular service registration.

---

# Application Lifecycle

The application boot process follows a structured flow:

```
public/index.php

        ↓

bootstrap/app.php

        ↓

Container

        ↓

ProviderLoader

        ↓

Application

        ↓

Request Pipeline

        ↓

Router
```

The bootstrap layer is responsible only for preparing the framework.

Application functionality is separated into services and providers.

---

# Routing System

Sendity includes a dedicated routing layer.

Routes are stored separately from the framework bootstrap:

```
routes/

    web.php
```

Example:

```php
$router->get('/', [HomeController::class, 'index']);
```

Routing responsibilities are separated:

```
RoutingServiceProvider

        ↓

RouteLoader

        ↓

routes/web.php
```

This creates a foundation for future support of:

* API routes
* Admin routes
* Route groups
* Middleware-based routing
* Route caching

---

# Request Handling

Requests flow through the application pipeline:

```
HTTP Request

      ↓

Request Object

      ↓

Middleware Pipeline

      ↓

Router Dispatch

      ↓

Controller / Response
```

---

# Exception Handling

Sendity includes a central exception handling system.

Exceptions are captured by the application lifecycle and processed through the framework exception handler.

This provides a consistent location for:

* Error reporting
* Logging
* Exception rendering

---

# Events

Sendity includes an event system supporting:

* Events
* Listeners
* Dispatching

Example:

```php
$events->dispatch(
    new MailSent(
        'user@example.com',
        'Hello Sendity!'
    )
);
```

This allows framework features to communicate without tightly coupling components.

---

# Project Structure

Current structure:

```
Sendity/

├── app/

│   ├── Core/

│   ├── Controllers/

│   ├── Events/

│   ├── Listeners/

│   ├── Providers/

│   ├── Routing/

│   └── Services/

│

├── bootstrap/

│   └── app.php

│

├── config/

│

├── routes/

│   └── web.php

│

├── public/

│   └── index.php

│

└── vendor/
```

---

# Design Principles

Sendity follows several core principles:

## Separation of Responsibilities

Each component has a clear role:

* Container manages dependencies
* Providers register services
* RouteLoader loads routes
* Router handles matching requests
* Application controls execution flow

---

## Shared Application Lifecycle

The container itself is part of the framework lifecycle.

The container now manages its own lifecycle by binding itself as a singleton, ensuring providers and services receive the shared application container instance.

This prevents accidental creation of isolated framework instances.

---

## Modular Growth

The architecture is designed to grow without rewriting the foundation.

Future areas include:

* Authentication
* Database layer
* ORM
* CLI tools
* Queues
* Scheduling
* Package system
* Middleware groups
* Configuration caching

---

# Development Status

Sendity is currently under active development.

Completed foundation:

✅ Dependency Injection Container
✅ Singleton lifecycle management
✅ Service Providers
✅ ProviderLoader
✅ Router
✅ Request handling
✅ Response handling
✅ Middleware pipeline
✅ Exception handling
✅ Event system
✅ RouteLoader architecture

---

# Documentation

Detailed architecture notes are maintained separately and cover:

* Framework lifecycle
* Container design
* Provider architecture
* Routing architecture
* Future development plans

---

# License

License information will be added as the project develops.

```
```
