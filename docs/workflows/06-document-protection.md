# Sendity Document Protection Workflow

## Overview

The Document Protection workflow describes how a user optionally protects a document shared through Sendity.

Document protection exists to give the sender greater control over important documents without making ordinary email attachments complicated.

Protection is optional.

---

# Goal

The goal of this workflow is:

> Allow a sender to share a document with the level of control appropriate for its purpose.

---

# Domain Concepts Involved

This workflow involves:

```text
Identity

Message

Document

Policy

Security

Insight
```

---

# Starting Point

A user is creating or editing an email.

The email may contain a document.

Example:

```text
Message

    |

    ▼

Document
```

The document may be:

```text
Unprotected
```

or:

```text
Protected
```

---

# Protection Is Optional

Normal documents should remain simple.

Example:

```text
Attach PDF

        ↓

Send Email
```

No additional protection workflow is required.

When additional control is needed:

```text
Attach PDF

        ↓

Protect Document

        ↓

Configure Controls

        ↓

Send Email
```

---

# When Protection Is Appropriate

Protection may be useful for documents such as:

- financial information
- contracts
- confidential reports
- personal information
- internal documents
- sensitive business material

The sender decides whether protection is necessary.

---

# Protection Controls

A sender may choose controls such as:

```text
Allow Download

Prevent Download

Allow Printing

Prevent Printing

Expiry

Watermark

Protected Viewing

Encryption
```

Not every protection capability needs to be enabled.

---

# Protection Policy

Protection settings represent sender intent.

Example:

```text
Confidential Document Policy

Download: Disabled

Printing: Disabled

Expiry: 7 days

Watermark: Enabled
```

The policy describes how the document should behave.

---

# Policy Snapshot

Before the protected communication is sent:

```text
Policy Template

        |

        ▼

Policy Snapshot

        |

        ▼

Document
```

The snapshot preserves the exact protection rules used for that communication.

---

# Why The Snapshot Matters

A previously sent document must remain historically accurate.

Example:

At the time of sending:

```text
Download: Allowed

Printing: Disabled

Expiry: 30 days
```

The sender later changes the reusable policy:

```text
Download: Disabled

Printing: Disabled

Expiry: 7 days
```

The previously sent document must continue using its original policy.

---

# Protected Viewing

When protected viewing is enabled:

```text
Recipient

    |

    ▼

Protected Document

    |

    ▼

Sendity Viewer
```

The document should be presented through the Sendity viewing experience.

The recipient should not need to understand the underlying protection technology.

---

# Download Control

If downloading is allowed:

```text
Recipient

    |

    ▼

View Document

    |

    ▼

Download
```

If downloading is disabled:

```text
Recipient

    |

    ▼

View Document

    |

    ▼

Download Unavailable
```

The user should receive a clear explanation rather than a technical error.

---

# Printing Control

If printing is allowed:

```text
View

    ↓

Print
```

If printing is disabled:

```text
View

    ↓

Printing Unavailable
```

The restriction should be presented clearly.

---

# Expiry

A document may have an expiry date.

Example:

```text
Document expires:

11 Aug 2026
```

Before expiry:

```text
Document Available
```

After expiry:

```text
Document Expired
```

The recipient should understand that access has ended.

---

# Watermarking

A sender may optionally enable watermarking.

Example:

```text
Confidential

Recipient:
alex@example.com

Date:
4 Aug 2026
```

Watermarking supports accountability and document awareness.

It should not be presented as surveillance.

---

# Encryption

Encryption may optionally protect document contents.

When encryption is enabled:

```text
Document

    |

    ▼

Encrypted

    |

    ▼

Protected Viewing
```

Encryption is a security capability supporting document protection.

It does not change the identity of the document within the communication domain.

---

# Recipient Experience

The recipient should see a simple experience.

For example:

```text
You have received a protected document.

View Document
```

The recipient should not need to understand:

```text
Encryption keys

Policy snapshots

Access tokens

Storage systems

PDF processing
```

Those are implementation concerns.

---

# Document Insights

Protected documents may generate meaningful Insights.

Examples:

```text
Document Viewed

Document Downloaded

Document Printed

Document Expired
```

The sender can use these Insights to understand what happened to the shared document.

Technical implementation details should remain hidden.

---

# Security Events

Security-related events may occur during protected document access.

Examples:

```text
Access Denied

Identity Verification Required

Document Access Expired
```

These should be presented in understandable language.

---

# Changing Protection

Once a protected document has been sent, its historical policy should remain stable.

A sender changing a reusable policy should not unexpectedly change previously sent communication.

Future messages use the new policy.

Existing messages retain their snapshots.

```text
Policy Template

        |

        +───────────────► New Message
        |                   New Snapshot
        |
        |
        └───────────────► Existing Message
                            Existing Snapshot
```

---

# Removing Protection

A sender may choose not to protect a document before sending.

Before sending:

```text
Protected

        ↓

Remove Protection

        ↓

Normal Document
```

Once the communication has been sent, protection behaviour should follow the policy snapshot associated with that communication.

---

# Technical Boundaries

This workflow does not define:

- PDF.js implementation
- encryption algorithms
- key storage
- document storage
- access token implementation
- download prevention mechanisms
- browser security mechanisms

Those belong to technical architecture and security design.

---

# Design Rules

1. Document protection is optional.
2. Normal attachments should remain simple.
3. Documents are first-class communication resources.
4. Protection represents sender intent.
5. Policy templates create immutable policy snapshots.
6. Previously sent documents must retain their original protection behaviour.
7. Security should support the document experience rather than dominate it.
8. Recipient experiences should remain simple.
9. Protection outcomes should be understandable.
10. Document Insights should describe meaningful actions rather than technical tracking events.

---

# Guiding Principle

The sender should be able to say:

> **"I want to share this document, but I also want to control how it is accessed."**

Sendity should make that possible without making ordinary email unnecessarily complicated.