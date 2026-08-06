# Sendity Project Context

> **This document is the project's source of truth.**
>
> Before introducing new features or making architectural decisions, review this document to ensure development remains aligned with Sendity's purpose and values.

---

# What is Sendity?

Sendity is a secure communication platform built around **trust, control, and simplicity**.

Its purpose is to help people create, send, receive, and understand digital communications with confidence.

Sendity is communication-first.

Technology exists to support communication, not become the product.

---

# What Sendity Is Not

Sendity is **not**:

- an email marketing platform
- an analytics platform
- a surveillance or tracking tool
- a generic PHP framework
- a queue framework
- a document management system

Those technologies may exist inside Sendity, but they are not its purpose.

---

# Product Vision

Every feature should support one or more of these goals:

- trusted communication
- sender control
- recipient respect
- document protection
- communication understanding
- optional security
- simplicity

If a feature does not improve communication, it probably does not belong.

---

# Core Values

## Trust

Communication should be transparent, honest and dependable.

Trust is earned—not assumed.

---

## Control

The sender decides.

Technology should assist communication, never dictate it.

---

## Simplicity

Powerful when you need it.

Invisible when you don't.

Advanced capabilities should always remain optional.

---

# Product Philosophy

Sendity is organised around **communication**, not sending.

Sending and receiving are equal experiences.

Users think in terms of mailboxes and conversations—not SMTP transactions.

---

# Core Domain

The product is built around these concepts:

```text
Identity

Mailbox

Conversation

Message

Document

Template

Policy

Insight

Security
```

These are product concepts.

Infrastructure exists to support them.

---

# Domain Principles

## Identity

One email address represents one Identity.

A person may own multiple identities.

Trust belongs to identities.

Security belongs to identities.

---

## Mailboxes

Mailboxes organise communication.

Users experience Sendity through mailboxes.

Not through transport protocols.

---

## Conversations

Messages belong to conversations.

Communication should preserve context.

---

## Messages

A message is a communication event.

Not simply an SMTP payload.

---

## Documents

Documents are first-class communication resources.

They are not merely attachments.

---

## Templates

Templates represent reusable intent.

Examples include:

- message templates
- policy templates

Templates create new instances.

Templates themselves are never modified by sent communication.

---

## Policies

Policies describe how communication should behave.

Policy templates create immutable policy snapshots.

Changing a template must never affect previously sent messages or documents.

---

## Insights

Insights help users understand communication.

Insights are not tracking.

Users should see:

```text
Message Viewed

Document Viewed

Recipient Interaction

Communication Timeline
```

Users should never see implementation terminology such as:

```text
Tracker Hit

Pixel Fired

Tracking Event
```

The codebase should reflect this philosophy wherever practical.

---

## Security

Security supports communication.

Security does not define communication.

Security features should remain optional whenever possible.

Examples include:

- PGP
- digital signatures
- encrypted documents
- identity verification

---

# Document Protection Philosophy

Document controls should be optional.

Examples include:

- allow download
- prevent download
- allow printing
- prevent printing
- expiry
- watermarking
- PDF.js protected viewing
- optional encryption

Encrypted documents should only be viewable through the Sendity PDF viewer when that protection is enabled.

---

# Receiving Philosophy

Receiving is not the opposite of sending.

Receiving is a parallel experience.

Both should receive equal design attention.

Users should be able to:

- organise incoming communication
- understand communication history
- manage conversations
- apply policies
- review insights

---

# Technical Boundaries

The project separates technical architecture from domain architecture.

Framework:

> How Sendity runs.

Queue:

> How background work executes.

Domain:

> What Sendity represents.

These concerns should remain separate.

---

# Language Rules

Always prefer language that users understand.

Prefer:

```text
Viewed

Downloaded

Printed

Expired

Protected

Insight
```

Avoid:

```text
Tracker

Pixel

TrackerHit

PixelFire

AnalyticsEvent
```

Implementation details should not become product language.

---

# Development Principles

Before implementing a feature, ask:

1. Which domain concept owns this?
2. Does this improve communication?
3. Does this align with Sendity values?
4. Does this introduce unnecessary complexity?
5. Would a user naturally understand this concept?

If the answer to these questions is unclear, stop and clarify before coding.

---

# Current Direction

Current priorities include:

- mailboxes
- conversations
- messages
- document controls
- reusable templates
- reusable policies
- communication insights
- PGP support
- PDF.js integration

Infrastructure exists only to support these experiences.

---

# Decision Process

Large changes should follow this order:

```text
Project Context

        ↓

Architecture

        ↓

ADR

        ↓

Implementation
```

Ideas should be validated before code is written.

Avoid building a solution first and discovering the requirement afterwards.

---

# Guiding Question

When making any design decision, ask:

> **Does this make Sendity a better communication platform?**

If not, reconsider the change.