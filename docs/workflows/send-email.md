# Sendity Send Email Workflow

## Overview

The Send Email workflow describes how a user creates and sends an email through Sendity.

Sending an email is one of the core experiences of Sendity.

The workflow connects:

```
Identity

Mailbox

Conversation

Message

Document

Policy

Queue

Insight
```

The workflow describes the user's goal:

> Send an email with confidence and understand what happens afterwards.

---

# Goal

The goal of this workflow is:

> Allow a user to create, send, protect, and understand an email communication.

---

# Domain Concepts Involved

This workflow involves:

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

---

# Starting Point

The user has:

```
A Sendity account

A configured email Identity

Access to a Mailbox
```

The Identity should be in a usable state.

Example:

```
Identity Status:

Healthy
```

---

# Email Creation

The user begins creating an email.

The user may provide:

```
Recipients

Subject

Message content

Documents

Templates

Policies
```

At this stage the user is creating an email experience.

They are not interacting with delivery infrastructure.

---

# Message Creation

A Message represents the email communication.

The Message contains:

```
Sender Identity

Recipient Identities

Content

Documents

Applied Policies
```

A Message may exist as:

```
Draft

Ready

Sent

Delivered

Viewed

Archived
```

---

# Identity Selection

A user may have multiple identities.

Example:

```
alex@gmail.com

alex@company.com

support@business.com
```

The user chooses which Identity represents the sender.

The selected Identity becomes the owner of the outgoing email.

---

# Conversation Handling

When creating an email:

Sendity determines whether the message belongs to:

```
New Conversation
```

or:

```
Existing Conversation
```

A conversation provides context.

Messages should not exist as disconnected events.

---

# Template Usage

A user may start from a template.

Example:

```
Customer Response Template

Invoice Template

Legal Notice Template
```

The template creates a new message instance.

The sent message does not modify the original template.

---

# Document Attachment

Documents are first-class communication resources.

Adding a document creates a relationship:

```
Message

    |

    ▼

Document
```

A document may include:

- content
- metadata
- protection rules
- access requirements

---

# Applying A Policy

A user may apply a policy to a message or document.

Example:

```
Confidential Document Policy

Finance Policy

Legal Policy
```

Policies represent sender intent.

---

# Policy Snapshot Creation

Before sending, reusable policies become snapshots.

The process:

```
Policy Template

        |

        ▼

Policy Snapshot

        |

        ▼

Message / Document
```

The snapshot preserves the exact rules that existed when the email was sent.

---

# Why Policy Snapshots Exist

A sent email must remain historically accurate.

Example:

Today:

```
Finance Policy

Download Allowed

Expiry: 30 days
```

Tomorrow:

The template changes:

```
Download Disabled

Expiry: 7 days
```

The previously sent email should not change.

---

# Security Application

Optional security features may be applied.

Examples:

```
Encryption

Digital Signature

Identity Verification

Protected Document Viewing
```

Security supports the email experience.

It does not redefine the email itself.

---

# Sending Request

When the user chooses send:

The message becomes ready for delivery.

The process:

```
Message Ready

        |

        ▼

Delivery Requested

        |

        ▼

Background Processing
```

---

# Queue Interaction

The Queue system supports background work.

The workflow boundary is:

```
Send Email Request

        |

        ▼

Queue

        |

        ▼

Delivery Processing
```

The user does not interact with:

- queue workers
- drivers
- storage
- retry systems

Those belong to technical architecture.

---

# Delivery Outcomes

After processing, the email may have outcomes.

Examples:

## Successful

```
Email Sent

Email Delivered
```

---

## Failed

```
Email Delivery Needs Attention
```

The user should receive understandable information.

Not raw infrastructure errors.

---

# Credential Health Relationship

If delivery fails because of identity authentication:

The issue belongs to Identity Health.

Example:

```
Email could not be sent.

The sending identity requires attention.

The stored credential has not authenticated successfully since:

4 Aug 2026 15:42

Would you like to update it?
```

---

# Insight Creation

Email activity may create Insights.

Examples:

```
Email Sent

Email Delivered

Message Viewed

Document Viewed

Recipient Interaction
```

Insights help users understand what happened.

---

# Recipient Experience

The recipient should experience normal email.

Additional Sendity capabilities should only appear where enabled.

Examples:

- protected documents
- secure viewing
- controlled access

The recipient experience should remain simple.

---

# Technical Boundaries

This workflow does not define:

- SMTP communication
- IMAP handling
- queue implementation
- storage systems
- encryption implementation

Those belong to technical architecture.

---

# Design Rules

1. Sending begins with user intent, not transport.
2. Messages represent communication, not SMTP payloads.
3. Identities represent senders and recipients.
4. Documents are first-class resources.
5. Policies create immutable snapshots.
6. Queue systems support delivery but do not define the experience.
7. Insights describe outcomes using human language.
8. Technical failures should become understandable user states.

---

# Guiding Principle

A user should be able to answer:

> "What happened to my email?"

Sendity should provide that answer with clarity and confidence.