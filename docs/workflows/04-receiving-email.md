# Sendity Receive Email Workflow

## Overview

The Receive Email workflow describes how incoming email enters Sendity and becomes part of the user's mailbox.

Receiving is a first-class experience.

Sendity should help users organise, understand, and act on incoming email—not simply store it.

---

# Goal

The goal of this workflow is:

> Allow a user to receive, organise, understand, and trust incoming email.

---

# Domain Concepts Involved

```
Identity

Mailbox

Conversation

Message

Document

Insight

Security
```

---

# Starting Point

The user has:

```
A healthy Identity

A connected Mailbox
```

The sending party may or may not be using Sendity.

Receiving should work regardless.

---

# Incoming Email

An email arrives for one of the user's Identities.

```
Incoming Email

        |

        ▼

Identity recognised

        |

        ▼

Mailbox receives message
```

---

# Identity Matching

Sendity determines which Identity owns the email.

Example:

```
support@company.com

        |

        ▼

Support Mailbox
```

If multiple Identities exist, each receives only its own communication.

---

# Conversation Matching

Sendity determines whether the message belongs to:

```
Existing Conversation
```

or

```
New Conversation
```

Conversations preserve communication context.

Users should experience discussions rather than isolated emails.

---

# Message Creation

The incoming communication becomes a Message.

The Message contains:

```
Sender

Recipients

Subject

Content

Documents

Attachments

Metadata
```

---

# Mailbox Organisation

The Message becomes available through the Mailbox.

Possible views include:

```
Inbox

Unread

Starred

Archived

Custom folders
```

Organisation should help users manage communication rather than merely store it.

---

# Document Recognition

If the email contains documents:

```
Message

        |

        ▼

Document
```

If the sender used Sendity document protection, the document should retain its behaviour.

Examples:

- protected viewing
- expiry
- watermarking
- download restrictions

If the sender did not use Sendity, the document behaves as a normal attachment.

---

# Security Evaluation

Incoming email may undergo optional security evaluation.

Examples include:

```
Signature verification

Encryption detection

Identity verification

Security warnings
```

Security should help users make informed decisions.

It should not overwhelm normal email usage.

---

# Insight Generation

Receiving may create Insights.

Examples:

```
Email Received

Identity Verified

Protected Document Available

Security Warning
```

Insights describe meaningful events.

They should not expose technical processing.

---

# User Outcomes

Possible outcomes include:

## Successful

```
Email received

Conversation updated

Documents available
```

---

## Security Warning

```
This sender's identity could not be verified.
```

---

## Protected Content

```
This email contains protected documents.

Open securely?
```

---

# Technical Boundaries

This workflow does not define:

- IMAP implementation
- message storage
- parsing engines
- spam filtering
- encryption algorithms

Those belong to technical architecture.

---

# Design Rules

1. Receiving is equal in importance to sending.
2. Incoming email should become part of conversations.
3. Mailboxes organise communication.
4. Documents remain first-class resources.
5. Security should assist understanding, not interrupt it.
6. Users should understand the state of incoming communication without needing technical knowledge.

---

# Guiding Principle

A user should be able to answer:

> "What has arrived, who sent it, and what do I need to do?"

Sendity should make those answers immediately clear.