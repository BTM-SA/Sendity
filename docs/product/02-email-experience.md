# Sendity Email Experience

## Overview

Sendity is an email platform.

The primary user experience should therefore feel familiar to anyone who already understands email.

Sendity should improve the email experience without forcing users to understand the technology behind it.

The experience is built around:

```text
Mailbox

Conversations

Messages

Documents

Templates

Insights

Identity

Security
```

These capabilities should work together without making the user manage the underlying architecture.

---

# Experience Principle

Sendity should feel like email first.

Advanced capabilities should become available when they are useful, but they should not dominate the ordinary email experience.

The guiding principle is:

> **Familiar first. Powerful when needed.**

This extends the broader Sendity principle:

> **Powerful when you need it. Invisible when you don't.**

---

# What Users Should Think About

Users should think in terms of:

```text
Emails

People

Conversations

Documents

Templates

Security

What happened to my email?
```

Users should not need to think in terms of:

```text
SMTP

Queue

Transport

Message lifecycle

Tracking pixels

Event processors

Queue jobs

Domain objects
```

The technical architecture exists beneath the experience.

---

# Primary Experience

The normal Sendity experience should be simple.

A user should be able to:

```text
Open Sendity

    ↓

See Mailbox

    ↓

Open Conversation

    ↓

Read Email

    ↓

Reply
```

Or:

```text
Open Sendity

    ↓

Compose

    ↓

Write Email

    ↓

Send
```

No additional configuration is required for ordinary email.

---

# Mailbox Experience

The mailbox is the primary entry point into Sendity.

Users should understand it immediately.

The mailbox should provide access to:

```text
Inbox

Sent

Drafts

Other Mailbox Views
```

The exact mailbox structure may evolve.

The important principle is that users experience Sendity through their mailboxes rather than through technical sending or receiving mechanisms.

---

# Conversation Experience

Messages should be presented in conversational context where appropriate.

A conversation allows the user to understand:

```text
Who communicated

What was communicated

When communication occurred

What documents were involved

What happened afterwards
```

A conversation should feel like a continuing exchange rather than a collection of unrelated technical messages.

---

# Message Experience

A message should present the information users actually care about.

For example:

```text
From

To

Date

Subject

Message

Documents
```

Where applicable, the message may also expose:

```text
Insights

Security State

Document State

Communication Timeline
```

These should remain secondary to the email itself.

The message content should remain the primary focus.

---

# Compose Experience

The compose experience should be intentionally simple.

The default workflow is:

```text
Compose

    ↓

Recipients

    ↓

Subject

    ↓

Message

    ↓

Send
```

A user should not need to configure templates, policies, security, documents, or insights before sending an ordinary email.

---

# Optional Capabilities

Advanced capabilities should be:

```text
Discoverable

Optional

Accessible

Non-intrusive
```

They should not be:

```text
Mandatory

Hidden

Confusing

Constantly interrupting
```

---

# Template Discovery

Templates should be available from the compose experience.

For example:

```text
[ Templates ]
```

The control should be visible enough that users can discover it without searching through Settings.

However, it should not dominate the compose experience.

Selecting it may expose:

```text
Message Templates

    Invoice
    Quotation
    Customer Response


Settings Templates

    Invoice
    Confidential
    Standard
```

---

# Message Templates

A Message Template provides reusable:

```text
Subject

Message Content

Formatting

Layout
```

When selected, it creates a starting point for the new email.

The user remains free to modify it.

Example:

```text
Message Template
        ↓
Compose
        ↓
User modifies message
        ↓
Send
```

The template itself is never changed by the user's modifications.

---

# Settings Templates

A Settings Template provides reusable settings for:

```text
Communication

Document Control

Security
```

The user may apply a Settings Template without using a Message Template.

Example:

```text
Compose

    ↓

Apply Settings Template

    ↓

Write Email

    ↓

Send
```

---

# Template Independence

The two template types must remain independently usable.

Users may choose:

```text
Message Template only

Settings Template only

Both

Neither
```

The default remains:

```text
Neither
```

Templates are never mandatory.

---

# Linked Templates

A Message Template may optionally have a preferred Settings Template.

Example:

```text
Invoice Message
       |
       ▼
Suggested:
Invoice Settings
```

This relationship should be presented as a convenience.

The user may:

```text
Apply

Modify

Choose another Settings Template

Ignore
```

The linked Settings Template must never become a requirement.

---

# Template Modifications

When a template is applied, the user should be able to modify the resulting email.

For a Message Template:

```text
Change Subject

Change Message

Change Formatting

Add Documents
```

For a Settings Template:

```text
Change Communication Settings

Change Document Controls

Change Security Settings
```

Changes affect the current email only.

---

# Documents

Documents should be treated as first-class email resources.

They should not feel like an afterthought hidden behind a generic attachment mechanism.

The user should be able to understand:

```text
Which documents are included

How documents can be accessed

Whether documents are protected

Whether documents expire
```

---

# Document Controls

Where applicable, document controls should be available without forcing them into the normal email workflow.

Examples:

```text
Allow Download

Prevent Download

Allow Printing

Prevent Printing

Expiry

Watermark

Protected Viewing
```

These controls should appear when the user chooses to configure document protection.

---

# Security

Security capabilities should be discoverable but optional.

Examples include:

```text
Encryption

PGP

Digital Signatures

Identity Verification

Protected Access
```

The user should be able to send an ordinary email without understanding or configuring cryptographic systems.

When security is enabled, the experience should clearly communicate the resulting protection.

---

# Credential Health

Credential Health belongs to the Identity experience.

Users should be able to understand whether Sendity can currently use an email account.

Example:

```text
Work

john@company.com

Credential
Healthy
```

When a problem exists:

```text
Work

john@company.com

Credential
Needs Attention
```

The user should be able to access the problem and recover without needing to understand SMTP or authentication protocols.

---

# Authentication Failure

When Sendity knows that the current credential has been rejected, the user should receive useful information.

Example:

```text
SMTP authentication failed.

The currently stored credential has not authenticated successfully since:

4 Aug 2026 15:42

[Update Credential]
```

The message should communicate:

```text
What happened

When the account last worked

What the user can do next
```

A temporary connection problem should not be presented as an invalid password unless Sendity has evidence that the credential was rejected.

---

# Password Experience

Passwords should be hidden by default.

Example:

```text
Password
[••••••••••••] [Show]
```

The user may temporarily reveal the password.

Example:

```text
Password
[password] [Hide]
```

This is a convenience feature.

Password visibility should always remain under the user's control.

---

# Insights

Insights help users understand what happened after an email was sent.

They should not feel like analytics dashboards.

Useful language includes:

```text
Message Viewed

Document Viewed

Link Accessed

Recipient Interaction

Communication Timeline
```

Avoid exposing technical terminology such as:

```text
Tracker Hit

Pixel Fired

Tracking Event
```

---

# Insight Placement

The email itself remains primary.

Insights should provide additional understanding without replacing the message.

A possible experience is:

```text
Email
    |
    +── Message
    |
    +── Documents
    |
    +── Insights
    |
    +── Timeline
```

Insights should appear when they provide meaningful information.

They should not overwhelm the email.

---

# Communication Timeline

Where useful, Sendity may present a timeline showing meaningful communication events.

Example:

```text
10:32
Email sent

10:41
Message viewed

10:44
Document viewed

11:03
Link accessed
```

The timeline should describe actual communication events in human language.

---

# Delivery And Insights

Delivery and Insights are different concepts.

Delivery answers:

> **Did Sendity successfully send the email?**

Insights answer:

> **What happened after the email was sent?**

For example:

```text
Email Sent
    ↓
Delivery
    ↓
Message Viewed
    ↓
Document Viewed
```

A delivery failure should not be described as an Insight.

---

# Error Experience

Sendity should avoid generic technical error messages where it has enough information to provide something more useful.

Avoid:

```text
Error 535

Authentication failed

Exception occurred

Transport failure
```

Prefer:

```text
Email could not be sent.

The stored credential was not accepted by the email service.

[Update Credential]
```

Errors should explain:

1. What happened.
2. What it means.
3. What the user can do next.

---

# Progressive Disclosure

Sendity should reveal complexity progressively.

The default experience should expose the most important information first.

Advanced information should become available when requested.

Example:

```text
Simple

Email could not be sent.

Credential needs attention.

[Update Credential]
```

Optional additional information:

```text
Why?

Last successful authentication:
4 Aug 2026 15:42
```

Technical diagnostics may exist separately for appropriate users or administrative tools.

---

# User Control

Sendity should never make decisions on behalf of the user when the user should reasonably be making that decision.

Examples:

```text
Template suggested
    → User decides

Settings suggested
    → User decides

Security available
    → User decides

Document protection available
    → User decides
```

Recommendations may assist the user.

They should not silently change the user's intended email.

---

# Review Before Sending

Where an email contains meaningful configuration, Sendity may provide an optional review experience.

The user should be able to understand:

```text
Recipients

Subject

Message

Documents

Communication Settings

Document Controls

Security
```

The review should be proportional to the complexity of the email.

A simple email should remain simple.

An email containing protected documents and encryption may reasonably provide more information before sending.

---

# Sending

The final action should remain clear:

```text
[ Send ]
```

The user should not need to understand:

```text
Queue

SMTP

Transport

Worker

Job
```

The system may use all of these internally.

They are not part of the email experience.

---

# After Sending

After an email is sent, the user should receive clear confirmation.

For example:

```text
Email sent.

To:
john@example.com

Subject:
Invoice #1042
```

Where relevant, Sendity may also expose:

```text
Delivery State

Documents

Security State

Insights
```

---

# Receiving

Receiving should receive equal design attention to sending.

The user should be able to:

```text
Receive

Read

Understand

Respond

Organise
```

The receiving experience should not feel like a secondary feature.

---

# Replying

Replying should preserve conversation context.

The user should not need to manually reconstruct:

```text
Recipients

Subject

Conversation Context
```

unless they choose to change them.

The normal workflow is:

```text
Open Conversation

    ↓

Reply

    ↓

Write

    ↓

Send
```

---

# Forwarding

Forwarding should preserve the user's control over what is shared.

The user should be able to understand:

```text
Original Message

Documents

Recipients

Security Controls
```

before forwarding.

Protected documents or restricted resources should not silently lose their protections.

The final behaviour should be determined by the applicable policies and user choices.

---

# Conversation Continuity

Sendity should preserve context across:

```text
Replies

Forwards

Documents

Insights

Communication Events
```

The user should experience the conversation as a coherent history.

---

# UI Language

Sendity should use human language.

Prefer:

```text
Send

Receive

View

Download

Print

Protect

Expire

Viewed

Delivered

Needs Attention

Healthy

Insight
```

Avoid exposing internal implementation names.

Examples to avoid:

```text
MailDeliveryLifecycle

TrackerHit

PixelFire

QueueJob

SMTPTransport

MessageEnvelope
```

These may exist in the codebase.

They should not define the user experience.

---

# Familiarity

Sendity should not attempt to make email unfamiliar simply because it provides advanced capabilities.

Users should recognise:

```text
Inbox

Sent

Compose

Reply

Forward

Subject

Attachment

Conversation
```

Sendity's innovation should come from improving the experience around these familiar concepts.

---

# Complexity Budget

Every additional decision presented to a user has a cost.

Sendity should therefore ask:

> **Does the user need to make this decision right now?**

If not, defer it.

For example:

```text
Simple Email
    ↓
Send
```

not:

```text
Simple Email
    ↓
Choose Template?
    ↓
Choose Policy?
    ↓
Configure Security?
    ↓
Configure Insights?
    ↓
Configure Documents?
    ↓
Confirm Settings?
    ↓
Send
```

The second experience violates the simplicity principle.

---

# Optional Does Not Mean Hidden

A capability can be optional while remaining easy to discover.

Sendity should aim for:

```text
Forced
    ❌

Hidden
    ❌

Difficult to find
    ❌

Discoverable + Optional
    ✓
```

This principle applies to:

```text
Templates

Security

Document Controls

Insights

Advanced Settings
```

---

# Experience Hierarchy

The experience should generally follow this hierarchy:

```text
Email
  |
  ├── Message
  |
  ├── Conversation
  |
  ├── Documents
  |
  ├── Security
  |
  └── Insights
```

The email remains the centre.

Supporting capabilities should enhance the email rather than compete with it.

---

# Experience Before UI

This document defines the intended email experience.

It does not define exact screens.

The next UI design stage should determine:

```text
Navigation

Layouts

Components

Controls

Interaction patterns

Responsive behaviour

Visual hierarchy
```

UI decisions must remain consistent with this experience.

---

# Experience Before Implementation

Implementation should follow the experience.

The intended sequence is:

```text
Northstar

    ↓

Domain

    ↓

Workflow

    ↓

Email Experience

    ↓

UI Design

    ↓

Implementation
```

Implementation should not dictate the experience.

---

# Design Rules

1. Sendity is an email platform first.
2. The default experience should feel familiar.
3. Advanced capabilities should be discoverable but optional.
4. Users must be able to send ordinary email without configuring advanced features.
5. Templates are optional and independently usable.
6. Message Templates control reusable email content and presentation.
7. Settings Templates control reusable email configuration.
8. A Message Template may optionally suggest a Settings Template.
9. Suggestions must never become requirements.
10. Documents are first-class email resources.
11. Document protection is optional.
12. Security is optional.
13. Credential Health belongs to the Identity experience.
14. Passwords are hidden by default.
15. Insights describe meaningful communication outcomes.
16. Insights must not expose technical tracking terminology.
17. Delivery and Insights are separate concepts.
18. Errors should explain what happened, what it means, and what the user can do next.
19. Technical infrastructure must remain hidden from ordinary email interactions.
20. Complexity should be progressively disclosed.
21. Users should retain control over meaningful decisions.
22. Simple emails should remain simple.
23. Complex emails may expose additional review and configuration.
24. Receiving and sending should receive equal design attention.
25. Conversations should preserve communication context.
26. UI design should follow the experience rather than define it.
27. Implementation should follow the experience rather than dictate it.

---

# Guiding Principle

Sendity should make email better without making email harder.

A user should be able to send a simple email without thinking about Sendity's advanced capabilities.

When the user needs more control, Sendity should make those capabilities easy to discover.

The experience should therefore remain:

```text
Familiar

Simple

Discoverable

Powerful

Controlled
```

The technology underneath may be sophisticated.

The email experience should not require the user to know that.