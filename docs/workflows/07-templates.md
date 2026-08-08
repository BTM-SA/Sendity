# Sendity Template Workflow

## Overview

Sendity supports two distinct types of reusable templates:

```text
Message Templates

Settings Templates
```

They solve different problems.

A **Message Template** provides reusable email content and presentation.

A **Settings Template** provides reusable configuration for how an email, its documents, and its security features should behave.

The two may optionally be linked, but neither depends on the other.

This allows users to:

- use a pre-styled email with predefined settings
- use a pre-styled email with different settings
- use settings without a pre-styled email
- create an email without either template

---

# Goal

The goal of this workflow is:

> Allow users to reuse email content and email settings independently or together while remaining in control of the final email.

---

# Template Types

Sendity recognises two primary template types:

```text
Message Template

Settings Template
```

---

# Message Template

## Purpose

A Message Template represents reusable email content and presentation.

It provides a starting point for creating a new email.

### A Message Template May Contain

```text
Subject

Message Content

Formatting

Layout

Reusable Fields

Suggested Documents
```

Example:

```text
Invoice Message Template

Subject:
Invoice {{invoice_number}}

Content:

Hello {{recipient_name}},

Please find your invoice attached.

Regards,

Accounts
```

A Message Template represents reusable intent.

It does not represent a sent email.

---

# Settings Template

## Purpose

A Settings Template represents reusable configuration for an email.

It allows users to define how a particular category of email should behave.

Settings Templates may contain settings for:

```text
Communication

Document Control

Security
```

---

# Communication Settings

Communication settings may control capabilities such as:

```text
Delivery Insights

Message Views

Recipient Interaction

Communication Timeline
```

The exact available settings may evolve as Sendity develops.

The important principle is that the settings describe **what Sendity should provide for that email**.

---

# Document Control Settings

Document-control settings may define:

```text
Download Permission

Printing Permission

Document Expiry

Watermarking

Protected Viewing
```

These settings apply where the email contains applicable documents.

---

# Security Settings

Security settings may define:

```text
Encryption

Digital Signatures

Identity Verification

Protected Access

Security Requirements
```

Security remains optional.

Users should only enable the capabilities appropriate to the email.

---

# Example Settings Template

A user may create:

```text
Invoice Settings
```

with:

```text
Communication
────────────────────────
Delivery Insights: Enabled
Message Views: Enabled
Recipient Interaction: Enabled

Document Control
────────────────────────
Download: Allowed
Printing: Allowed
Expiry: 30 days

Security
────────────────────────
Encryption: Enabled
Identity Verification: Optional
```

The template provides a reusable starting configuration.

---

# Templates Are Independent

A Message Template does not require a Settings Template.

A Settings Template does not require a Message Template.

This creates four possible experiences.

---

# Option 1 — Message Template + Settings Template

The user chooses:

```text
Invoice Message Template

        +

Invoice Settings Template
```

Sendity provides:

```text
Pre-styled Invoice Email

        +

Invoice communication settings

        +

Invoice document controls

        +

Invoice security settings
```

This provides a complete reusable email pattern.

---

# Option 2 — Message Template Only

The user chooses:

```text
Invoice Message Template
```

The email receives the reusable content and styling.

The user can then configure settings manually.

```text
Message Template

        ↓

New Email

        ↓

User configures settings

        ↓

Send
```

---

# Option 3 — Settings Template Only

The user chooses:

```text
Invoice Settings
```

Sendity applies the reusable settings to a normal email.

```text
Compose Email

        ↓

Apply Invoice Settings

        ↓

Write any content

        ↓

Send
```

The user does not need to use the Invoice Message Template.

---

# Option 4 — Neither Template

The user can simply compose an email normally.

```text
Compose

        ↓

Write

        ↓

Send
```

Templates are never mandatory.

---

# Optional Template Linking

A Message Template may optionally have a preferred Settings Template.

Example:

```text
Invoice Message Template

        |

        | preferred settings
        ▼

Invoice Settings Template
```

This relationship is a convenience.

It does not make the Settings Template mandatory.

---

# Using A Linked Template

The user selects:

```text
Invoice Message
```

Sendity may suggest:

```text
Invoice Settings
```

The user can:

```text
Apply

Modify

Choose another Settings Template

Keep current settings
```

The user remains in control.

The suggestion must never prevent the user from continuing without applying the settings.

---

# Per-Email Modification

Templates provide defaults.

They do not dictate the final email.

After applying a template, the user may modify:

```text
Message Content

Subject

Formatting

Communication Settings

Document Controls

Security Settings
```

These changes apply only to the new email.

They do not modify the reusable template.

---

# Template Independence

The relationship should be understood as:

```text
Message Template
       |
       +───────────────► New Email
       |
       +───────────────► New Email
       |
       +───────────────► New Email
```

and:

```text
Settings Template
       |
       +───────────────► New Email Settings
       |
       +───────────────► New Email Settings
       |
       +───────────────► New Email Settings
```

Each resulting email becomes independent.

---

# Resulting Email Configuration

When an email is sent, Sendity combines the user's choices.

For example:

```text
Message Template
       +
Settings Template
       +
User Modifications
       +
Documents
```

becomes:

```text
Final Email
```

The final email represents the actual communication the user chose to send.

---

# Settings Snapshot

Once the email is sent, the resulting settings must become historically stable.

The process is:

```text
Settings Template

        ↓

User Modifications

        ↓

Final Email Settings

        ↓

Settings Snapshot

        ↓

Sent Email / Document
```

The snapshot represents the settings actually applied to that email.

---

# Why Snapshots Matter

Suppose the user has:

```text
Invoice Settings

Download: Allowed
Printing: Allowed
Expiry: 30 days
```

They send an email.

Later they change the reusable template:

```text
Download: Disabled
Printing: Disabled
Expiry: 7 days
```

The previously sent email must continue using:

```text
Download: Allowed
Printing: Allowed
Expiry: 30 days
```

The new settings apply only to future emails.

---

# Message Template Changes

Message Templates follow the same principle.

Suppose:

```text
Invoice Message
```

originally contains:

```text
Please find your invoice attached.
```

The user later changes the template to:

```text
Please find your invoice attached.

Please contact Accounts if you have any questions.
```

Future emails receive the new version.

Previously created or sent emails do not change.

---

# Template And Insight Relationship

A Settings Template does not directly create Insights.

Instead:

```text
Settings Template

        ↓

Email Settings

        ↓

Email Behaviour

        ↓

Actual Event

        ↓

Insight
```

For example:

```text
Message Views: Enabled

        ↓

Recipient views email

        ↓

Message Viewed
```

Or:

```text
Document Views: Enabled

        ↓

Recipient opens document

        ↓

Document Viewed
```

The Insight represents something that actually happened.

The Settings Template only configured whether the relevant capability was enabled.

---

# Template And Security Relationship

Security settings follow the same model.

Example:

```text
Invoice Security Template

Encryption:
Enabled
```

When applied:

```text
Settings Template

        ↓

Encryption Enabled

        ↓

Email Sent Securely
```

The resulting email retains the applicable security configuration.

Changing the reusable Settings Template later does not retroactively change previous emails.

---

# Template And Document Relationship

A Message Template may optionally provide suggested documents.

Example:

```text
Invoice Message Template

        +

Suggested Invoice Document
```

The user may:

```text
Use the suggested document

Replace it

Remove it

Add another document
```

The final Email determines what is actually sent.

---

# Shared Templates

Templates may optionally be shared.

Examples:

```text
Personal Templates

Organisation Templates

Team Templates
```

A shared Message Template may provide:

```text
Company-approved email wording
```

A shared Settings Template may provide:

```text
Company-approved email settings
```

Using a shared template does not prevent appropriate permissions from being applied to modification.

---

# Template Ownership

A template may belong to:

```text
User

Organisation

Team
```

The ownership model should determine:

- who can use it
- who can modify it
- who can delete it
- whether it is shared

These rules are separate from the template's actual content.

---

# Template Deletion

Deleting a template affects future use only.

It must not modify existing emails.

```text
Template

        ↓

Deleted

        X

Future use unavailable


Existing Email

        ↓

Remains unchanged
```

---

# Template Categories

Templates may be organised into categories.

Examples:

```text
Invoices

Customer Service

Finance

Legal

Sales

Personal
```

Categories help users find reusable templates.

They do not change the underlying template behaviour.

---

# User Experience

## Optional Does Not Mean Hidden

Templates are entirely optional.

Users do not need to:

- enable templates
- agree to use templates
- select a template before composing
- dismiss template prompts
- configure template settings before sending a normal email

The default experience remains:

```text
Compose

        ↓

Write

        ↓

Send
```

However, optional features should remain **discoverable**.

A user who wants to use a template should not have to search through multiple settings screens to find it.

---

# Template Discovery

The compose experience should provide an obvious but unobtrusive way to access templates.

For example:

```text
Compose Email

[ Templates ]
```

Selecting the control may expose:

```text
Message Templates

    Invoice
    Customer Response
    Quotation


Settings Templates

    Invoice
    Confidential
    Standard
```

The exact UI will be determined during UI design.

The principle is:

```text
Forced      ❌

Hidden      ❌

Discoverable + Optional    ✓
```

---

# Template Suggestions

When a Message Template has a preferred Settings Template, Sendity may make the relationship visible.

Example:

```text
Invoice

Message + Settings
```

or:

```text
Invoice Message

Suggested:
Invoice Settings
```

The user may accept, modify, replace, or ignore the suggested settings.

The suggestion must never become a requirement.

---

# Simplicity Principle

A user who wants to send a simple email should never need to understand:

```text
Message Templates

Settings Templates

Policy Snapshots

Security Profiles
```

unless they choose to use those capabilities.

Advanced capabilities should remain available without becoming part of the ordinary email workflow.

---

# Technical Boundaries

This workflow does not define:

- template storage
- database structures
- template rendering engines
- variable substitution implementation
- settings persistence
- settings snapshot implementation
- encryption implementation
- policy implementation
- template APIs

Those belong to technical architecture.

---

# Design Rules

1. Sendity has two distinct template types: Message Templates and Settings Templates.
2. Message Templates provide reusable email content and presentation.
3. Settings Templates provide reusable email configuration.
4. Settings Templates may contain Communication, Document Control, and Security settings.
5. Message Templates and Settings Templates are independent.
6. A Message Template may optionally be linked to a preferred Settings Template.
7. A linked Settings Template is a convenience, not a requirement.
8. Users may use a Message Template without its linked Settings Template.
9. Users may use a Settings Template without using a Message Template.
10. Users may use neither template.
11. Templates provide defaults, not restrictions.
12. Users may modify template-derived content and settings before sending.
13. Modifications apply only to the new email.
14. Reusable templates must never be modified by an email created from them.
15. Sent email must retain a stable snapshot of its resulting settings.
16. Changing a reusable Settings Template must not change previous email.
17. Changing a reusable Message Template must not change previous email.
18. Settings Templates configure capabilities; they do not directly create Insights.
19. Insights represent actual email events and outcomes.
20. Templates are entirely optional.
21. Optional features should be discoverable rather than hidden.
22. A user must always be able to send a normal email without using templates.
23. Template suggestions must never prevent the user from continuing without them.

---

# Guiding Principle

Templates should answer two different questions:

> **"What should this email look and sound like?"**

and:

> **"How should this email and its documents behave?"**

Sendity should allow users to answer either question independently—or both together—without taking control away from them.

The simplest email should remain simple.

The powerful options should be easy to discover when the user needs them.