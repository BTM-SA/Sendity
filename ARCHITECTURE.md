# Sendity Architecture

## Philosophy

Sendity is designed to be:

- Privacy First
- Self Hosted
- Lightweight
- Easy to Read
- Easy to Extend
- Framework Driven

---

## Core Components

-Application

Responsible for bootstrapping the framework.

-Configuration

Loads application settings from the config directory and provides centralized access to application configuration.

-Container

Resolves dependencies automatically using reflection.

-Router

Matches HTTP requests to controllers or closures.

-Pipeline

Executes middleware before the router.

-Request

Represents the incoming HTTP request.

-Response

Represents the outgoing HTTP response.

-Middleware

Intercepts requests before they reach controllers.

-Controllers

Handle application logic.

-Services

Reusable business logic.

---

## Request Lifecycle

Browser

↓

Application

↓

Pipeline

↓

Middleware

↓

Router

↓

Controller

↓

Response

↓

Browser