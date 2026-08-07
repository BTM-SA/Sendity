# Sendity Queue Architecture

## Overview

The Sendity Queue system provides asynchronous job execution.

The queue system is responsible for managing background work while keeping application business logic separate from execution concerns.

The queue system is responsible for:

- dispatching jobs
- storing queued jobs
- retrieving queued jobs
- executing jobs
- handling failures
- applying retry policies

The queue system does not contain application business logic.

---

# Queue Architecture

The queue system is built around three main concepts:

```
Queue Management

        |

        ▼

Queue Drivers

        |

        ▼

Queue Storage
```

Execution is handled separately by workers.

---

# Structure

```
QueueManager
      |
      v
QueueDriverManager
      |
      v
QueueDriverInterface
      |
      +----------------+
      |                |
      v                v
SyncQueueDriver   FileQueueDriver
                       |
                       v
              QueueStorageInterface
                       |
                       v
              FileQueueStorage


QueueWorker
      |
      +-- RetryPolicy
      |
      +-- JobEnvelope
      |
      +-- Job execution
```

---

# QueueManager

The QueueManager provides the application-facing queue interface.

It is responsible for:

- accepting jobs
- creating queue envelopes
- dispatching jobs to the configured driver

The QueueManager does not:

- execute jobs
- store jobs directly
- manage retries

---

# QueueDriverManager

The QueueDriverManager resolves the configured queue driver.

Responsibilities:

- loading queue configuration
- selecting the active driver
- returning the correct queue implementation

Example drivers:

```
sync

file
```

Additional drivers may be added in the future.

---

# Queue Drivers

Queue drivers implement:

```
QueueDriverInterface
```

A queue driver defines how jobs enter and leave the queue system.

Drivers do not:

- execute application logic
- decide retry behaviour
- understand job internals

---

# SyncQueueDriver

## Purpose

The SyncQueueDriver executes jobs immediately.

Used for:

- testing
- development
- local execution

Example:

```
Dispatch Job

      |

      ▼

Execute Immediately
```

The SyncQueueDriver is not intended for production workloads.

---

# FileQueueDriver

## Purpose

The FileQueueDriver provides persistent local queue storage.

Used for:

- standalone deployments
- local installations
- simple persistent queues

The FileQueueDriver delegates persistence to:

```
QueueStorageInterface
```

---

# Queue Storage

Storage is responsible only for persistence.

It handles:

- saving jobs
- loading jobs
- deleting jobs
- counting queued items

Storage does not:

- execute jobs
- apply retry rules
- contain business logic

---

## Current Storage Implementation

```
FileQueueStorage
```

---

## Future Storage Implementations

Possible future implementations:

- database storage
- Redis storage
- external queue services

The storage contract should remain unchanged.

---

# QueueWorker

The QueueWorker is responsible for executing queued jobs.

The worker lifecycle:

```
Retrieve Job
      |
      v
Execute Job
      |
      +----------------+
      |                |
      v                v
   Success          Failure
      |                |
      v                v
  Complete       RetryPolicy
                       |
              +--------+--------+
              |                 |
              v                 v
           Retry             Failed
```

The worker does not know:

- where jobs are stored
- which storage driver is used
- which queue driver dispatched the job

The worker only executes jobs.

---

# JobEnvelope

A JobEnvelope represents queued job metadata.

It contains information required to manage execution.

Example information:

- job identity
- payload reference
- attempt count
- maximum attempts
- failure information

The envelope does not execute the job.

---

# RetryPolicy

RetryPolicy controls failure behaviour.

It decides:

- whether another attempt is allowed
- maximum retry count
- next attempt information
- failure handling rules

Retry behaviour belongs to the policy, not the worker.

---

# Queue Design Rules

1. Queue drivers must not contain business logic.
2. Storage implementations must not execute jobs.
3. Workers must not depend on storage implementations.
4. Jobs must not know which queue driver is being used.
5. Retry behaviour must remain separate from execution.
6. New queue features should extend existing contracts instead of moving responsibilities.

---

# Future Development

The queue system may later support:

- delayed jobs
- scheduled execution
- priority queues
- distributed workers
- failed job storage
- queue monitoring

These features should extend the current architecture rather than change existing responsibilities.