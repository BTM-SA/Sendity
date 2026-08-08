# Sendity Conversation Workflow

## Overview

The Conversation workflow describes how Sendity groups related emails into an ongoing exchange.

A Conversation provides context around email exchanged between people and organisations.

The purpose is not simply to group messages.

The purpose is to help a user understand:

- who they are communicating with
- what has been said
- what has happened
- what needs attention
- where the conversation currently stands

---

# Goal

The goal of this workflow is:

> Allow users to understand and manage an ongoing email conversation without losing context.

---

# Domain Concepts Involved

This workflow involves:

```text
Identity

Mailbox

Conversation

Message

Document

Policy

Insight
```

---

# Starting Point

A conversation may begin when:

```text
User sends an email
```

or:

```text
User receives an email
```

A conversation may therefore begin from either side of communication.

---

# Creating A Conversation

When an email does not belong to an existing conversation:

```text
Message

    |

    ▼

New Conversation
```

The conversation becomes the context for the message.

---

# Adding Messages

When another related email is received or sent:

```text
Conversation

    |

    +── Message

    +── Message

    +── Message
```

The conversation grows as communication continues.

Messages remain individual records of communication.

The Conversation provides the surrounding context.

---

# Conversation Participants

A conversation may involve multiple identities.

Example:

```text
alex@company.com

customer@example.com

accounts@example.com
```

The conversation should make participants understandable to the user.

Users should not need to understand message headers or technical threading identifiers.

---

# Replies

When a user replies to an email:

```text
Conversation

        |

        ▼

Reply

        |

        ▼

New Message

        |

        ▼

Conversation Updated
```

The reply remains part of the same conversation when appropriate.

---

# New Conversations

Not every email from the same person belongs to the same conversation.

For example:

```text
Subject: Invoice 1042
```

and:

```text
Subject: Holiday Schedule
```

may represent different conversations.

Conversation grouping should preserve meaningful context rather than simply grouping every message from the same participants.

---

# Conversation Context

A Conversation provides a history of communication.

The user should be able to understand:

```text
Who participated

What was sent

What was received

When communication occurred

Which documents were shared

Which policies were applied

What interactions occurred
```

---

# Documents In Conversations

Documents remain first-class resources.

Example:

```text
Conversation

    |

    +── Message

          |

          +── Document
```

A document may be associated with a particular message while remaining part of the broader conversation context.

---

# Protected Documents

If a document is protected:

```text
Conversation

    |

    ▼

Message

    |

    ▼

Protected Document
```

The conversation should make the document's state understandable.

Examples:

```text
Protected

Available

Expired

Access Restricted
```

The user should not need to understand the underlying protection mechanism.

---

# Policy Context

A message or document may have an applied policy.

The conversation may show the resulting state of that communication.

Examples:

```text
Download restricted

Document expires 7 Aug 2026

Printing disabled
```

The conversation does not own the policy.

The policy remains associated with the message or document.

---

# Insights In Conversations

Insights provide meaningful information about what happened during a conversation.

Examples:

```text
Email Sent

Email Delivered

Message Viewed

Document Viewed

Document Downloaded

Recipient Interaction
```

Insights should appear as part of the communication history.

Example:

```text
You sent an email
        |
        ▼
Email delivered
        |
        ▼
Message viewed
        |
        ▼
Document viewed
```

This provides a communication timeline.

---

# Insight Language

Users should see:

```text
Message Viewed

Document Viewed

Document Downloaded

Recipient Interaction
```

Not:

```text
Tracking Pixel Fired

Tracker Hit

Tracking Event Received
```

Technical tracking mechanisms remain implementation details.

---

# Conversation Status

A conversation may have a user-facing state.

Examples:

```text
Active

Needs Attention

Waiting for Reply

Resolved

Archived
```

These states should help users manage their email.

They should not represent internal technical states.

---

# Needs Attention

A conversation may require user attention.

Examples:

```text
A recipient replied

A delivery failed

A protected document expired

A security warning was raised
```

The user should be able to understand why the conversation needs attention.

---

# Waiting For Reply

A conversation may be waiting for another participant.

Example:

```text
You sent:

"Please confirm the attached quotation."

        |

        ▼

Waiting for Reply
```

This allows Sendity to represent the user's communication context rather than simply displaying messages.

---

# Resolved Conversations

A conversation may be considered resolved when the user no longer needs to act on it.

Example:

```text
Customer request

        ↓

Response sent

        ↓

Customer confirms

        ↓

Resolved
```

Resolving a conversation does not delete its messages.

---

# Archiving

Archiving removes a conversation from active mailbox views while preserving its history.

```text
Active Conversation

        |

        ▼

Archive

        |

        ▼

Archived Conversation
```

The communication remains available.

---

# Searching Conversations

Users should be able to find conversations using meaningful information.

Examples:

```text
Participant

Subject

Message content

Document

Date

Conversation state
```

Search should operate around user concepts rather than technical message identifiers.

---

# Conversation History

A conversation should preserve chronological context.

Example:

```text
4 Aug

You sent an email
        |
        ▼

5 Aug

Recipient replied
        |
        ▼

5 Aug

You replied
        |
        ▼

6 Aug

Document viewed
```

The history should allow the user to understand what happened without reconstructing events manually.

---

# Technical Boundaries

This workflow does not define:

- email header parsing
- Message-ID handling
- IMAP threading implementation
- database relationships
- search indexes
- storage implementation

Those belong to technical architecture.

---

# Design Rules

1. Conversations exist to preserve communication context.
2. Conversations may begin from either sent or received email.
3. Messages remain individual communication events.
4. Related messages should remain understandable as one ongoing exchange.
5. Conversations should not be grouped merely because participants are the same.
6. Documents remain first-class resources.
7. Policy behaviour remains attached to the relevant message or document.
8. Insights should help users understand what happened.
9. Technical tracking terminology must not leak into the user experience.
10. Conversation states should represent user-relevant situations.
11. Archiving should preserve communication history.
12. The conversation experience should remain understandable without knowledge of email infrastructure.

---

# Guiding Principle

A user should be able to open a conversation and immediately understand:

> **Who am I communicating with, what has been said, what has happened, and what needs my attention?**

Sendity should preserve that context from the first email to the last.