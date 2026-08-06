# ADR-0014 — Queue Architecture

## Status

Accepted

---

## Context

Sendity requires asynchronous processing for mail delivery, scheduled tasks, retries, and future background work.

The queue subsystem should be reusable by any framework component and must not be coupled to mail delivery.

The framework already follows a consistent architecture built around Managers, Driver Managers, Drivers, Contracts, and Service Providers. The queue subsystem should follow the same conventions to provide a predictable developer experience.

---

## Decision

The Queue subsystem will be composed of five distinct responsibilities.

### QueueManager

The public API exposed to the application.

The QueueManager is responsible for dispatching jobs and providing a stable interface to the queue subsystem.

The QueueManager never performs queue operations directly.

Its responsibility is orchestration.

---

### QueueDriverManager

Responsible for resolving the active queue driver from configuration.

The Driver Manager returns implementations of `QueueDriverInterface`.

Supported drivers may include:

* Sync
* File
* Database
* Redis

New drivers can be introduced without modifying the QueueManager.

---

### Queue Drivers

Queue drivers are responsible only for storing and retrieving queued work.

Drivers do not execute jobs.

Drivers do not implement retry logic.

Drivers do not contain business logic.

Drivers should remain simple persistence layers.

---

### QueueWorker

Responsible for executing queued work.

The QueueWorker retrieves queued jobs from the active driver and executes them.

The worker owns:

* Retry handling
* Failure handling
* Timeout handling
* Job lifecycle
* Queue execution

The worker does not contain business logic.

---

### Jobs

Jobs represent business actions.

Jobs should contain only application logic.

Jobs should not contain queue configuration such as:

* Retry counts
* Priorities
* Delays
* Scheduling information
* Queue names
* Timeout values

Jobs remain completely unaware of how they are executed.

---

## Job Envelope

Every queued job is wrapped inside a `JobEnvelope`.

The JobEnvelope owns all execution metadata, including:

* Job identifier
* Queue name
* Priority
* Delay
* Retry attempts
* Timeout
* Created timestamp
* Available timestamp
* Reserved timestamp
* Completed timestamp
* Failed timestamp
* Status

Drivers persist JobEnvelopes rather than serializing arbitrary job objects directly.

This separates business logic from infrastructure metadata.

---

## Retry Policy

Retry handling belongs to the Queue subsystem.

`RetryPolicy` is not a Mail concern.

Framework services such as Mail use the queue infrastructure rather than implementing retry behaviour independently.

---

## Architectural Principles

The queue subsystem follows the same architectural pattern established throughout Sendity.

```
Application
        │
        ▼
QueueManager
        │
        ▼
QueueDriverManager
        │
        ▼
QueueDriver
```

Execution is performed independently.

```
QueueWorker
        │
        ▼
JobEnvelope
        │
        ▼
Job
```

Responsibilities remain clearly separated.

Managers orchestrate.

Drivers persist.

Workers execute.

Jobs contain business logic.

---

## Consequences

### Positive

* Queue drivers remain simple persistence layers.
* Jobs remain focused solely on business logic.
* Retry behaviour is centralized.
* New queue drivers can be added without changing the public queue API.
* The architecture naturally supports delayed jobs, scheduled jobs, batching, dead-letter queues, priorities, and future distributed queue implementations.
* Framework services remain decoupled from queue implementation details.

### Negative

* The initial implementation requires more framework classes before the first queue driver is complete.
* Additional abstraction increases the number of framework components that developers must understand.

---

## Future Work

This architecture is designed to support future capabilities without architectural redesign.

Potential additions include:

* Delayed jobs
* Scheduled jobs
* Job priorities
* Queue workers
* Dead-letter queues
* Job chaining
* Job batching
* Queue middleware
* Distributed queue drivers
* Queue monitoring
* Metrics and instrumentation
* Worker supervisors
* Multiple named queues

---

## Notes

The Queue subsystem is considered foundational infrastructure within Sendity.

Business services should never communicate directly with queue drivers.

All interaction with the queue should occur through `QueueManager`, while execution remains the responsibility of `QueueWorker`.

This preserves a clean separation between application logic, orchestration, persistence, and execution, while keeping the framework consistent with the architectural patterns established by the Mail and Audit subsystems.
