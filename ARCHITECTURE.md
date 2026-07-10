<div align="center"><img src="https://btm-sa.co.za/F4STMAIL/Logo.png" alt="Sendity_Logo" width="400">
</div>

# Framework Architecture Notes

## Overview

Sendity is being built as a secure digital delivery platform on top of a modular PHP framework with a focus on clear separation of responsibilities, dependency injection, and service-based architecture.

The framework boot process is designed around three main concepts:

1. A central application container
2. Service providers for modular registration
3. Dedicated services responsible for framework features

---

# Application Boot Process

The application starts from:

```
public/index.php
```

which loads:

```
bootstrap/app.php
```

The bootstrap file is responsible only for creating and preparing the framework.

The process is:

```
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

The Sendity container is responsible for managing framework dependencies.

The container supports:

* Direct bindings
* Singleton services
* Automatic dependency resolution

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

> The container now manages its own lifecycle by binding itself as a singleton, ensuring providers and services receive the shared application container instance.

This prevents accidental creation of multiple container instances.

Without this protection, services could receive isolated containers containing different bindings and instances.

Example problem:

```
Container A

    |
    └── Router with registered routes


Container B

    |
    └── Empty Router
```

This caused routing failures because the application was receiving a different Router instance from the one where routes were registered.

The solution was ensuring the existing container instance is always reused.

---

# Provider System

Framework services are organised through service providers.

Providers allow Sendity to register framework components in a modular way.

Current providers:

```
app/Providers/

    AppServiceProvider.php

    RoutingServiceProvider.php
```

The ProviderLoader controls the loading process.

---

# ProviderLoader

Framework services are now registered through the ProviderLoader, establishing the foundation for modular service registration.

The loading process:

```
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

## register()

Used for adding services to the container.

Example:

```php
$this->container->singleton(
    Router::class,
    fn ($container) => new Router($container)
);
```

## boot()

Used after registration for starting services or loading configuration.

---

# AppServiceProvider

The AppServiceProvider registers core application services.

Current responsibilities include:

* Configuration
* Logger
* Exception Handler
* Event Dispatcher
* Route Loader

Example:

```
AppServiceProvider

    |

    ├── Config

    ├── Logger

    ├── ExceptionHandler

    ├── EventDispatcher

    └── RouteLoader
```

---

# Routing Architecture

Routing has been separated from the application bootstrap process.

Previously:

```
bootstrap/app.php

    |
    └── Route definitions
```

The framework now uses:

```
RoutingServiceProvider

        |

        ▼

RouteLoader

        |

        ▼

routes/web.php
```

---

# RoutingServiceProvider

The RoutingServiceProvider is responsible for registering the Router service.

Its job is:

* Create the Router
* Start routing services

It does not contain route definitions.

---

# RouteLoader

Route loading has been separated from the RoutingServiceProvider into a dedicated RouteLoader, creating a foundation for multiple route sources and future route management features.

RouteLoader receives:

* Router
* Container

as explicit dependencies.

Architecture:

```
RouteLoader

    |

    ├── Router

    ├── Container

    |

    ▼

routes/web.php
```

This keeps responsibilities clear:

* Router handles matching requests
* RouteLoader loads route definitions
* Route files define application routes

---

# Routes

Routes are now stored separately:

```
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

This allows future expansion:

```
routes/

    web.php

    api.php

    admin.php
```

---

# Router Lifecycle Lesson

A major framework lesson discovered during development:

The object registered during boot must be the same object used during execution.

The problem:

```
Router A

    |
    └── Routes registered


Router B

    |
    └── No routes
```

The application returned 404 responses because the application was dispatching requests through a different Router instance.

The solution was correcting container lifecycle handling.

This principle applies to all framework services.

---

# Current Sendity Architecture

```
public/index.php

        |

        ▼

bootstrap/app.php

        |

        ▼

Container

        |

        ▼

ProviderLoader

        |

        ├── AppServiceProvider

        |

        └── RoutingServiceProvider

                    |

                    ▼

              RouteLoader

                    |

                    ▼

              routes/web.php

        |

        ▼

Application

        |

        ▼

Request Pipeline

        |

        ▼

Router Dispatch
```

---

# Future Development Direction

The current foundation supports future framework features:

## Route API

Move from:

```php
$router->get('/');
```

towards:

```php
Route::get('/');
```

using a routing facade or static API layer.

---

## Additional Route Files

Support:

```
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

```
routes/
      ↓
cache
      ↓
fast application startup
```

---

# Summary

Sendity now has the foundation of a real framework:

✓ Dependency injection container
✓ Singleton lifecycle management
✓ Provider-based architecture
✓ Modular service registration
✓ Dedicated routing layer
✓ Route loading abstraction
✓ Separation between framework bootstrapping and application logic

The next architectural layer will build on this foundation rather than replacing it.
