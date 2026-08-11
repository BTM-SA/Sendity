

# Sendity North Star

> This document is the source of truth for Sendity's purpose, principles, and direction.
>
> Before introducing features, changing architecture, or making significant product decisions, review this document to ensure the work remains aligned with Sendity's purpose.

---

# Purpose

Sendity exists to make email more trusted, controlled, and understandable.

Email is the foundation.

Trusted communication is the goal.

Sendity helps people:

- create emails
- send emails
- receive emails
- understand email activity
- protect sensitive information
- maintain control over their email experience

Technology exists to support this experience, not become the experience itself.

---

# What Sendity Is

Sendity is a secure email platform built around:

- Trust
- Control
- Simplicity

Sendity is designed around the complete email experience.

Users do not experience email as:

- SMTP transactions
- IMAP sessions
- delivery pipelines
- tracking systems

Users experience:

- identities
- mailboxes
- conversations
- messages
- documents
- templates
- policies
- insights

---

# What Sendity Is Not

Sendity is not:

- an email marketing platform
- a surveillance platform
- an analytics platform
- a generic email tracker
- a document management system
- a generic PHP framework
- a queue framework
- a password manager

These technologies may exist inside Sendity.

They are not the purpose of Sendity.

---

# Why Sendity Exists

Email is one of the world's most important communication systems.

Yet after pressing send, people often lose visibility and control.

They may not know:

- whether the email was delivered
- whether it was viewed
- whether important documents were accessed
- whether their email identity is still working
- whether sensitive information remained protected

Sendity exists to improve confidence in email.

Not by collecting unnecessary information.

By giving people meaningful understanding and control.

---

# Core Values

## Trust

Email communication should be transparent, honest, and dependable.

Trust is earned, not assumed.

Sendity should explain what happened instead of hiding behind technical states.

---

## Control

The sender decides.

Technology should assist email communication.

Technology should never silently make decisions on behalf of the user.

---

## Simplicity

Powerful when needed.

Invisible when not needed.

Advanced capabilities should remain available without becoming the default experience.

---

# Human Intent Design

Users think in goals.

Not implementations.

Users do not wake up thinking:

> "I need to interact with a `MailDeliveryLifecycle` object."

They think:

> "I need to send an email."

> "I need to know if someone received it."

> "I need to protect this document."

> "I need to continue this conversation."

Technical concepts exist to support these goals.

They should never become the product experience.

---

# Email Domain Philosophy

Sendity is organised around email concepts.

The core domain is:

```
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

These represent the user's email experience.

Infrastructure exists to support these concepts.

---

# Identity Philosophy

One email address represents one Identity.

A person may have multiple identities.

Identity represents trust.

Identity owns:

- mailbox access
- credentials
- security settings
- email history

Credentials belong to identities.

Not servers.

---

# Credential Philosophy

Credentials exist to maintain reliable email communication.

Credentials should:

- remain protected
- support appropriate authentication methods
- have a clear health state
- provide understandable feedback

A failed login should not simply say:

```
Authentication failed.
```

It should explain:

```
SMTP authentication failed.

The currently stored credential has not authenticated successfully since:

4 Aug 2026 15:42

Would you like to update it?
```

Systems should help users recover.

Not merely report failure.

---

# Mailbox Philosophy

Mailboxes are where users experience email.

Users should think about:

- inboxes
- sent mail
- conversations
- history

Not:

- SMTP
- IMAP
- transport protocols

---

# Conversation Philosophy

Email messages exist within context.

Sendity should preserve relationships between messages.

Email should not become a collection of disconnected messages.

---

# Message Philosophy

A message is more than a transport payload.

A message represents an email interaction.

---

# Document Philosophy

Documents are first-class email resources.

They are not merely attachments.

Documents may optionally support:

- download controls
- printing controls
- expiry
- watermarking
- protected viewing
- encryption

Security should preserve sender intent.

---

# Template Philosophy

Templates capture reusable email intent.

Examples:

- email templates
- policy templates

Templates create new email experiences.

Sent emails should never modify the original template.

---

# Policy Philosophy

Policies describe how an email or document should behave.

Policies may define:

- security requirements
- document permissions
- expiry rules
- recipient controls

Reusable policy templates create starting points.

Previously sent emails and documents should preserve the policy state that existed when created.

---

# Insight Philosophy

Insights help users understand email activity.

Insights are not surveillance.

Sendity should expose meaningful information:

```
Email Viewed

Document Viewed

Recipient Interaction

Email Timeline
```

Sendity should avoid exposing implementation terminology:

```
Tracker Hit

Pixel Fired

Tracking Event
```

The codebase should reflect this philosophy wherever practical.

---

# Security Philosophy

Security supports email.

Security does not define email.

Security should remain optional where appropriate.

Examples:

- PGP encryption
- key management
- digital signatures
- encrypted documents
- identity verification

Security should protect email without making normal email communication unnecessarily difficult.

---

# Experience Philosophy

Sendity follows this order:

```
User Intent

        ↓

Workflow

        ↓

Experience

        ↓

UI

        ↓

Implementation
```

We design email experiences before screens.

We design workflows before interfaces.

We design the domain before code.

---

# Platform Direction

Sendity is designed as a secure email platform.

The primary direction is:

```
Cloud Platform

+

Self Hosted Platform
```

Once stable, Sendity may expand through:

```
Email Client Integrations

        ↓

Desktop Applications

        ↓

Mobile Applications
```

Future applications should derive from the same platform principles and domain model.

---

# Technical Boundaries

Sendity separates concerns.

Framework:

> How Sendity runs.

Queue:

> How background work executes.

Domain:

> What Sendity represents.

Experience:

> How users interact with Sendity.

Implementation:

> How decisions become software.

Each layer supports the layers above it.

---

# Language Rules

Prefer user language.

Use:

```
Viewed

Downloaded

Printed

Expired

Protected

Insight

Identity

Credential Health
```

Avoid:

```
Tracker

Pixel

TrackerHit

PixelFire

AnalyticsEvent
```

Implementation details should remain behind the product experience.

---

# Decision Framework

Before introducing a significant feature, ask:

1. Does this make Sendity a better email platform?

2. Does this improve trust, control, simplicity, or security?

3. Does this reflect how users naturally think about email?

4. Which domain concept owns this?

5. Would a user understand why this exists?

6. Is this solving a user problem or only a technical opportunity?

---

# Current Direction

Current focus areas:

- email identities
- mailboxes
- conversations
- messages
- documents
- templates
- policies
- insights
- credential health
- PGP support
- protected document experiences

Infrastructure exists only to support these experiences.

---

# Final Guiding Principle

When making any design decision, ask:

> Does this make Sendity a better email platform?

If not, reconsider the decision.

Email is the foundation.

Trusted communication is the goal.

---

# Related 

### Filetree
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/filetree.md">filetree.md</a></strong>
---
# Architecture Documentation

### Framework
The Sendity framework provides the foundation for Sendity features while remaining independent from the Sendity domain model.

>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/architecture/01-framework.md">Framework</a></strong>
---

### Domain
The Sendity domain model defines the core concepts that make up the Sendity communication platform.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/architecture/02-domain.md">Domain</a></strong>

---
### Queue

The queue system is responsible for managing background work while keeping application business logic separate from execution concerns.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/architecture/03-queue.md">Queue</a></strong>

---

# Workflow Documentation
### Purpose
Workflows describe how users achieve goals within Sendity.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/workflows/01-purpose.md">01-Purpose</a></strong>
---
### Identity
The Identity workflow describes how an email identity becomes available and reliable within Sendity.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/workflows/02-identity.md">02-Identity</a></strong>
---
### Sending email
The Send Email workflow describes how a user creates and sends an email through Sendity.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/workflows/03-send-email.md">03-Send email</a></strong>

---
### Receiving email
The Receive Email workflow describes how incoming email enters Sendity and becomes part of the user's mailbox.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/workflows/04-receiving-email.md">04-Receiving email</a></strong>

---
### Conversations
The Conversation workflow describes how Sendity groups related emails into an ongoing exchange.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/workflows/05-conversations.md">05-Conversations</a></strong>
---

### Document Protection
The Document Protection workflow describes how a user optionally protects a document shared through Sendity.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/workflows/06-document-protection.md">06-document-protection.md</a></strong>
---
### Templates
This workflow describes how Sendity supports two distinct types of reusable templates
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/workflows/07-templates.md">07-templates.md</a></strong>

---
### Communication Insights
This workflow describes how Communication Insights help users understand what happened after an email was sent.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/workflows/08-communication-insights.md">08-communication-insights.md</a></strong>

---
### Security and Identity
This workflow describes how Sendity helps users establish trust in an email identity and optionally use security capabilities when sending or receiving email.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/workflows/09-security-and-identity.md">09-security-and-identity.md</a></strong>

---

# Product Documentation

### Credential-health
This describes how Sendity gives users a clear understanding of whether the currently stored credential is working.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/product/01-credential-health.md">01-credential-health.md</a></strong>

---
### Email experience
This describes how Sendity should improve the email experience without forcing users to understand the technology behind it.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/product/02-email-experience.md">02-email-experience.md</a></strong>

---
# User Interface Documentation
### UI shell
The Sendity UI shell provides the structural foundation for the application.
>- <strong><a href="https://github.com/BTM-SA/Sendity/blob/main/docs/ui/ui-shell.md">ui-shell.md</a></strong>

