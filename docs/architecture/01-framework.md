# Sendity Framework Architecture

## Overview

Sendity is built on a modular PHP framework designed around clear separation of responsibilities, dependency injection, and service-based architecture.

The framework provides the foundation required for Sendity features by managing:

- application bootstrapping
- dependency management
- service registration
- routing
- framework lifecycle management

The framework does not contain application domain logic.

---

# Application Boot Process

The application starts from:

```text
public/index.php
```

which loads:

```text
bootstrap/app.php
```

The bootstrap process is responsible only for creating and preparing the application.

The lifecycle is:

```text
public/index.php

        |

        ▼

bootstrap/app.php

        |

        ▼

Container created

        |

        ▼

ProviderLoader loads providers

        |

        ▼

Application instance created

        |

        ▼

Application runs
```

---

# Service Container

The Sendity container manages framework dependencies.

The container supports:

- direct bindings
- singleton services
- automatic dependency resolution

Example:

```php
$container->bind(Logger::class, function () {
    return new Logger();
});
```

Singleton example:

```php
$container->singleton(Config::class, function () {
    return new Config();
});
```

A singleton is created once and reused throughout the application lifecycle.

---

# Container Lifecycle Management

The container itself is part of the framework lifecycle.

The container binds itself as a singleton:

> The container manages its own lifecycle by binding itself as a singleton, ensuring providers and services receive the shared application container instance.

This prevents accidental creation of multiple container instances.

Without this protection, services could receive isolated containers containing different bindings and instances.

Example problem:

```text
Container A

    |
    └── Router with registered routes


Container B

    |
    └── Empty Router
```

This can cause services to be registered on one instance while another instance is used during execution.

The solution is ensuring the same container instance is reused throughout the application lifecycle.

---

# Provider System

Framework services are organised through service providers.

Providers allow Sendity services to be registered in a modular way.

Framework provider infrastructure:

```text
app/Core/Providers/

    ServiceProvider.php

    ProviderLoader.php
```

Application providers:

```text
app/Providers/

    AppServiceProvider.php

    RoutingServiceProvider.php

    EventServiceProvider.php

    MailServiceProvider.php
```

---

# Framework and Application Provider Separation

Sendity separates provider infrastructure from application providers.

Framework provider infrastructure is responsible for implementing the provider system itself.

Examples:

- ServiceProvider
- ProviderLoader

Application providers are responsible for registering Sendity services.

Examples:

- MailServiceProvider
- EventServiceProvider
- RoutingServiceProvider

This separation keeps framework internals independent from application configuration.

---

# ProviderLoader

Framework services are registered through the ProviderLoader.

The loading process:

```text
ProviderLoader

        |

        ▼

Create provider instances

        |

        ▼

register()

        |

        ▼

boot()
```

Providers have two responsibilities:

---

## register()

Used for adding services to the container.

Example:

```php
$this->container->singleton(
    Router::class,
    fn ($container) => new Router($container)
);
```

---

## boot()

Used after registration for:

- starting services
- loading configuration
- performing startup tasks

---

# Application Providers

The AppServiceProvider registers core application services.

Current responsibilities include:

- configuration
- logger
- exception handler
- event dispatcher
- application services

Example:

```text
AppServiceProvider

    |

    ├── Config

    ├── Logger

    └── ExceptionHandler


EventServiceProvider

    |

    └── EventDispatcher


RoutingServiceProvider

    |

    ├── Router

    └── RouteLoader


MailServiceProvider

    |

    └── MailerInterface

            |

            ▼

      SmtpTransport
```

---

# Routing Architecture

Routing is separated from the application bootstrap process.

Previously:

```text
bootstrap/app.php

    |

    └── Route definitions
```

Current architecture:

```text
RoutingServiceProvider

        |

        ▼

RouteLoader

        |

        ▼

routes/web.php
```

---

# Routing Responsibilities

## Router

Responsible for:

- matching requests
- dispatching routes

The Router does not load route definitions.

---

## RoutingServiceProvider

Responsible for:

- registering the Router service
- starting routing services

The RoutingServiceProvider does not contain route definitions.

---

## RouteLoader

Responsible for:

- loading route definitions
- providing future route sources

Dependencies:

- Router
- Container

Architecture:

```text
RouteLoader

    |

    ├── Router

    ├── Container

    |

    ▼

routes/web.php
```

---

# Routes

Routes are stored separately from the framework.

Structure:

```text
routes/

    web.php
```

Example:

```php
$router->get(
    '/',
    [HomeController::class, 'index']
);
```

Future expansion:

```text
routes/

    web.php

    api.php

    admin.php
```

---

# Router Lifecycle Lesson

A major framework lesson discovered during development:

> The object registered during boot must be the same object used during execution.

Problem:

```text
Router A

    |
    └── Routes registered


Router B

    |
    └── No routes
```

The application failed because execution was using a different Router instance from the one where routes were registered.

The solution was correcting container lifecycle handling.

This principle applies to all shared framework services.

---

# Framework Design Rules

1. Framework services must have clear ownership.
2. Shared services must respect container lifecycle.
3. Providers register services; they do not contain application logic.
4. Framework infrastructure must remain separate from domain logic.
5. Services should be resolved through the container.
6. New framework features should extend existing responsibilities instead of moving them.

---

# Future Development Direction

The current foundation supports future framework features:

## Route API

Future:

```php
Route::get('/');
```

using a routing API or facade layer.

---

## Additional Route Files

Support:

```text
routes/

    web.php

    api.php

    admin.php
```

---

## Middleware Groups

Example:

```php
Route::middleware('auth')
    ->group(...)
```

---

## Route Caching

Future route compilation:

```text
routes

    ↓

cache

    ↓

faster startup
```

---

# Summary

Sendity framework foundations include:

✓ Dependency injection container  
✓ Singleton lifecycle management  
✓ Provider-based architecture  
✓ Modular service registration  
✓ Dedicated routing layer  
✓ Route loading abstraction  
✓ Separation between framework bootstrapping and application logic  

The framework provides the foundation for Sendity features while remaining independent from the Sendity domain model.