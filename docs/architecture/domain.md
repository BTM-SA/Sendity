# Sendity Domain Architecture

## Overview

The Sendity domain model defines the core concepts that make up the Sendity communication platform.

This document describes what exists in Sendity and the relationships between those concepts.

It does not describe implementation details.

Technical concerns such as:

- framework architecture
- queue execution
- storage systems
- service providers

are documented separately.

---

# Core Domain Principles

Sendity is organised around communication rather than sending alone.

The system is built around:

```
Identity

Mailbox

Conversation

Message

Document

Policy

Insight

Security
```

These concepts represent the user's communication experience.

---

# Identity

## Purpose

An Identity represents a single communication endpoint.

An Identity answers:

> "Who is participating in communication?"

An Identity is not necessarily a person.

It represents the address through which communication occurs.

---

## Core Rule

One email address = one Identity.

Example:

```
alex@company.com
```

and:

```
alex@gmail.com
```

are separate identities.

Even if they belong to the same person.

---

## Responsibilities

Identity is responsible for:

- representing a communication address
- identifying senders and recipients
- maintaining identity information
- maintaining trust information
- connecting security capabilities

---

## Owns

Identity owns:

```
Email address

Display name

Organisation information

Trust state

Security associations
```

---

## Does Not Own

Identity does not own:

- messages
- documents
- policies
- insights

Identity participates in communication but does not contain communication history.

---

# Mailbox

## Purpose

A Mailbox represents where communication is organised.

Users interact with Sendity through mailboxes rather than through individual sending actions.

---

## Responsibilities

Mailbox is responsible for:

- organising messages
- presenting communication history
- separating incoming and outgoing communication
- providing user access to conversations

---

## Owns

Mailbox owns:

```
Message collections

Conversation access

Folders or views
```

---

## Does Not Own

Mailbox does not own:

- identity
- message content
- document policies
- queue execution

---

# Conversation

## Purpose

A Conversation represents the ongoing relationship between communication participants.

It provides context around messages exchanged between identities.

---

## Responsibilities

Conversation is responsible for:

- grouping related messages
- presenting communication history
- maintaining communication context

---

## Relationships

```
Identity

      |

      ▼

Conversation

      |

      ▼

Messages
```

---

## Does Not Own

Conversation does not own:

- message execution
- document security
- policy rules

---

# Message

## Purpose

A Message represents a communication event between identities.

A message is the actual communication sent or received.

---

## Responsibilities

Message is responsible for:

- sender identity
- recipient identities
- message content
- attached documents
- applied policies
- communication events

---

## Owns

A Message owns:

```
Content

Sender Identity

Recipient Identities

Documents

Policy Snapshot

Communication History
```

---

## Does Not Own

A Message does not own:

- queue execution
- SMTP transport
- encryption implementation
- storage mechanisms

Those belong to technical layers.

---

# Document

## Purpose

A Document represents a shared resource attached to communication.

Documents are treated as first-class communication objects.

They are not simply file attachments.

---

## Responsibilities

Document is responsible for:

- representing shared content
- controlling document behaviour
- connecting document policies
- recording document interactions

---

## Owns

Document owns:

```
Document content

Document metadata

Document policy snapshot
```

---

## Does Not Own

Document does not own:

- message delivery
- mailbox organisation
- encryption systems

Security features support documents but do not define them.

---

# Policy

## Purpose

A Policy defines rules controlling how communication resources behave.

Policies represent sender intent.

---

## Policy Templates

Reusable policies are created as templates.

Example:

```
Finance Policy

Legal Policy

Confidential Policy
```

Templates are starting points.

They are not attached directly to messages.

---

## Policy Snapshot

When a message or document uses a policy, a snapshot is created.

Example:

```
Policy Template

        |

        ▼

Policy Snapshot

        |

        ▼

Message / Document
```

---

## Why Snapshots Exist

A sent communication must remain historically accurate.

Changing a template later must not change previous messages.

---

## Responsibilities

Policy controls:

- download permissions
- printing permissions
- expiry rules
- access behaviour
- security requirements

---

# Insight

## Purpose

Insight provides understanding about communication activity.

Insight replaces technical tracking concepts with user-focused communication information.

---

## Core Principle

Sendity does not expose technical tracking mechanisms.

Users do not need to understand:

```
Pixel fired

Tracker hit

Tracking event
```

They need meaningful information:

```
Message viewed

Document opened

Link accessed

Recipient interacted
```

---

## Responsibilities

Insight is responsible for:

- presenting communication outcomes
- summarising interactions
- helping users understand communication effectiveness

---

## Does Not Own

Insight does not own:

- message delivery
- document content
- identity

It is generated from communication events.

---

# Security

## Purpose

Security protects communication and identity.

Security supports the domain rather than defining it.

---

## Responsibilities

Security provides:

- encryption
- key management
- signatures
- verification
- access protection

---

## Identity Relationship

Security capabilities belong to identities.

Example:

```
Identity

    |

    +── Public Key

    +── Signature

    +── Verification State
```

---

## Document Security

Documents may optionally use security features.

Examples:

- encryption
- restricted access
- controlled viewing
- protected documents

Security options should remain optional.

---

# Domain Relationships

The overall communication model:

```
Identity

      |

      ▼

Mailbox

      |

      ▼

Conversation

      |

      ▼

Message

      |

      +----------------+

      |                |

      ▼                ▼

 Document          Policy


      |

      ▼

 Insight
```

---

# Domain Design Rules

1. Identity represents communication endpoints, not people.
2. One email address equals one Identity.
3. Mailboxes organise communication.
4. Messages represent communication events.
5. Documents are first-class communication resources.
6. Policies represent sender intent.
7. Policy templates create policy snapshots.
8. Insights describe communication outcomes using human language.
9. Security supports communication without becoming the product itself.
10. Technical infrastructure must not leak into domain concepts.

---

# Summary

Sendity is built around trusted communication.

The core model is:

```
Identity

↓

Communication

↓

Documents

↓

Policies

↓

Insights
```

The technical architecture exists to support this model.

The domain defines what Sendity is.