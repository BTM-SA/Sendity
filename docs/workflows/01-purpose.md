# Sendity Workflow Documentation

## Overview

Workflows describe how users achieve goals within Sendity.

They connect:

```
User Intent

        ↓

Domain Concepts

        ↓

System Behaviour

        ↓

Future Experience Design
```

Workflows explain what should happen from a user's perspective.

They do not describe implementation details.

---

# Purpose

The purpose of workflow documentation is to ensure Sendity is designed around user outcomes rather than technical systems.

Users do not think in terms of:

- services
- queues
- providers
- database records
- transport protocols

Users think in terms of:

- sending an email
- receiving an email
- protecting a document
- managing an identity
- understanding what happened

Workflows describe these experiences.

---

# Relationship To Other Documentation

Sendity documentation follows this structure:

```
PROJECT_NORTH_STAR.md

        |

        | Why Sendity exists

        ▼

Domain Architecture

        |

        | What exists in Sendity

        ▼

Workflow Documentation

        |

        | How users achieve goals

        ▼

UI Design

        |

        | How users interact

        ▼

Implementation
```

---

# What A Workflow Contains

A workflow should describe:

## Goal

What the user is trying to achieve.

Example:

```
User wants to send a protected email.
```

---

## Starting Point

What exists before the workflow begins.

Example:

```
User has:

- an email identity
- a mailbox
- a document
```

---

## Workflow Steps

The journey from intent to outcome.

Example:

```
Create message

        ↓

Add recipient

        ↓

Attach document

        ↓

Apply protection policy

        ↓

Send email
```

---

## Domain Concepts

The Sendity concepts involved.

Example:

```
Identity

Message

Document

Policy

Insight
```

---

## Outcomes

What can happen after the workflow completes.

Example:

```
Email sent successfully

Email delivery failed

Recipient interaction available
```

---

# Workflow Principles

## 1. Start With User Intent

Every workflow begins with:

> What is the user trying to accomplish?

Not:

> What technical process needs to happen?

---

## 2. Domain Concepts Come Before Implementation

Workflows should reference Sendity domain concepts.

Examples:

Use:

```
Identity

Mailbox

Message

Document

Policy

Insight
```

Avoid:

```
SMTP session

Database record

Queue worker

Controller
```

---

## 3. Technical Systems Support Workflows

Technical systems may enable workflows.

They do not define them.

Example:

A user workflow:

```
Send Email
```

May internally involve:

```
Queue

SMTP

Delivery Service

Storage
```

But the workflow remains:

```
Send Email
```

---

## 4. Workflows Should Reflect Reality

A workflow should describe what actually needs to happen.

It should not describe:

- unnecessary complexity
- internal architecture
- temporary implementation decisions

---

## 5. Workflows Guide Future UI Design

The UI should be created from workflows.

Not the other way around.

The process is:

```
Workflow

        ↓

User Experience

        ↓

Interface Design
```

---

# Workflow Language Rules

Use language users understand.

Prefer:

```
Email Sent

Email Delivered

Message Viewed

Document Protected

Credential Needs Attention
```

Avoid:

```
SMTP Transaction Completed

Tracker Event Received

Pixel Triggered

Credential Exception
```

Implementation terminology should remain behind the experience.

---

# Current Workflow Areas

Initial Sendity workflows include:

```
Identity Management

Mailbox Management

Send Email

Receive Email

Conversation Management

Document Protection

Policy Application

Template Usage

Credential Health

Insight Review
```

---

# Workflow Ownership

Each workflow should identify:

- the user goal
- the domain concepts involved
- expected outcomes
- important decisions

Workflows do not own:

- framework behaviour
- queue architecture
- storage design
- technical implementation

Those belong in architecture documentation.

---

# Guiding Principle

A workflow should answer:

> "What is the user trying to achieve, and what does Sendity need to do to help them achieve it?"

If the answer starts with a technical component instead of a user goal, the workflow should be reconsidered.