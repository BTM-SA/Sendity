# Sendity UI Shell

## Overview

The Sendity UI shell provides the structural foundation for the application.

It defines:

- primary navigation
- unified mailbox access
- mailbox and identity context
- search
- contextual navigation
- application identity
- account access
- workspace structure
- responsive behaviour

It does not define visual styling or implementation details.

The shell exists to help users navigate Sendity without making them feel as though they are navigating a technical system.

---

# Shell Principle

The Sendity shell should reflect the user's mental model of email.

Users should primarily think:

```text
Email

Inbox

Conversations

Messages

Compose

Documents

Templates

Insights
```

They should not feel that they are navigating separate technical subsystems.

---

# Primary Principle

The most important question when deciding whether something belongs in primary navigation is:

> **Does the user regularly come here to manage email?**

If the answer is yes, it may belong in primary navigation.

If the answer is no, it should generally be accessible contextually or through account/settings areas.

This prevents the navigation from becoming a list of every capability Sendity contains.

---

# Application Shell

The basic shell consists of:

```text
Application Header

        +

Primary Navigation

        +

Main Workspace
```

Conceptually:

```text
┌─────────────────────────────────────────────────────┐
│ Sendity                  Search          Account ▾  │
├────────────────┬────────────────────────────────────┤
│                │                                    │
│ Primary        │                                    │
│ Navigation     │        Main Workspace              │
│                │                                    │
│                │                                    │
└────────────────┴────────────────────────────────────┘
```

The shell should remain consistent while the main workspace changes according to the user's current task.

---

# Application Header

The header identifies the Sendity application and provides access to global actions.

The header may contain:

```text
Sendity

Search

Current Identity / Account

Notifications

Help

User Account
```

The exact controls may evolve.

The header should not become a second navigation system containing every Sendity feature.

---

# Search

Search is a core email capability.

It should be available without requiring the user to navigate to a dedicated "Search" page.

A persistent or easily accessible search field should be available within the application shell.

Example:

```text
┌──────────────────────────────────────────────┐
│ Search mail, people, conversations...       │
└──────────────────────────────────────────────┘
```

Search should feel like a natural part of managing email.

---

# Search Scope

Search should operate across the user's accessible email experience.

Depending on permissions and available indexing, search may include:

```text
Messages

Conversations

Senders

Recipients

Subjects

Document names

Document content where appropriate
```

Search should work naturally with the Unified Mailbox.

Example:

```text
Search

    ↓

Unified Mailbox

    ├── Personal
    ├── Work
    └── Finance
```

The user should not need to search each identity separately unless they specifically want to narrow the results.

---

# Search Filtering

Search may provide optional filters such as:

```text
Identity

Mailbox

Sender

Recipient

Date

Conversation

Has Document

Viewed

Unread
```

These filters should remain secondary to the basic search experience.

A simple search should remain simple.

---

# Search Principle

The user should be able to begin with:

```text
Search
```

rather than having to understand how Sendity stores or organises email.

The system may search across:

```text
Mailbox

Identity

Conversation

Message

Document
```

but the user should experience this as one email search.

---

# Primary Navigation

Primary navigation should focus on the user's everyday email activities.

The initial navigation should be centred around:

```text
Unified

Inbox

Sent

Drafts

Conversations
```

Compose should remain a prominent action rather than merely another navigation destination.

Example:

```text
Unified
Inbox
Sent
Drafts
Conversations

[ Compose ]
```

---

# Unified Mailbox

## Purpose

The Unified Mailbox provides a single view of communication across the user's accessible mailboxes and identities.

It exists so users do not have to constantly switch between identities simply to understand what is happening across their email.

Example identities:

```text
Personal
alex@gmail.com

Work
alex@company.com

Finance
accounts@company.com
```

The Unified Mailbox allows these to be viewed together.

---

# Unified Mailbox Principle

The Unified Mailbox is an aggregation view.

It does not replace the underlying mailboxes.

Conceptually:

```text
Unified Mailbox

        |

        +── Personal Mailbox
        |
        +── Work Mailbox
        |
        +── Finance Mailbox
```

Users can therefore move between:

```text
Unified View
```

and:

```text
Individual Mailbox / Identity View
```

without losing the underlying mailbox structure.

---

# Unified View

The unified view should allow users to understand:

```text
What is new?

What needs attention?

What conversations are active?

What messages have arrived?

What communication has recently occurred?
```

The user should not need to know which identity received a message before being able to see it.

---

# Identity Context in Unified Mailbox

Although the Unified Mailbox combines communication, the originating identity must remain understandable.

Example:

```text
John Smith
Invoice #4821

To:
accounts@company.com
```

or:

```text
John Smith
Invoice #4821

Work
```

The user should always be able to determine which identity or mailbox a message belongs to.

Unified does not mean ambiguous.

---

# Individual Mailbox Views

Users should still be able to focus on an individual mailbox.

Example:

```text
Work

Inbox
Sent
Drafts
```

The individual view is useful when users need to:

- manage a specific identity
- focus on work communication
- review mailbox-specific content
- understand mailbox-specific settings

The Unified Mailbox remains the default aggregation experience where appropriate.

---

# Mailbox Navigation

Mailbox-related destinations should form the primary navigation group.

Example:

```text
MAIL

Unified
Inbox
Sent
Drafts
Conversations
```

The exact relationship between Unified and Inbox may evolve during UI testing.

The important distinction is:

```text
Unified
    = aggregated email experience

Mailbox
    = specific mailbox / identity context
```

---

# Conversations

Conversations may have a dedicated navigation destination if Sendity's conversation model provides value beyond ordinary mailbox views.

Example:

```text
Conversations
```

The purpose is not to create another copy of the inbox.

It should provide a broader way of understanding ongoing communication.

If a conversation can be fully understood through the mailbox experience, the UI should avoid creating unnecessary duplication.

---

# Compose

Compose is a primary action.

It should be easy to find regardless of where the user is in the application.

Example:

```text
[ + Compose ]
```

The action may remain visually distinct from navigation items.

The user should never need to navigate to a special "Messages" area before being able to compose an email.

---

# Compose and Identity

When composing an email, the sending identity should be clear.

Example:

```text
Compose

From:
alex@company.com
```

If multiple identities are available, the user should be able to select the appropriate identity.

The application should never silently send from the wrong identity.

---

# Contextual Features

Some Sendity capabilities should generally be accessed in context rather than through primary navigation.

These include:

```text
Templates

Document Controls

Security

Insights
```

This is important.

Sendity contains powerful capabilities, but the user does not necessarily need to navigate to a separate section to use them.

---

# Templates

Templates should be discoverable from places where users create or configure email.

Primary location:

```text
Compose

    ↓

Templates
```

Templates may also have a management area for users who want to create, edit, organise, or delete templates.

Therefore:

```text
Template Usage
    → Contextual

Template Management
    → Secondary / Settings
```

This distinction prevents templates from becoming a mandatory part of ordinary email.

---

# Documents

Documents should primarily appear in the context of emails and conversations.

Example:

```text
Compose
    |
    └── Add Document

Message
    |
    └── Documents
```

A dedicated Documents area may exist for users who need to manage previously shared or protected documents.

However, it should not replace contextual document access.

The normal user should not need to think:

> "I need to open the Documents application before I can attach something."

---

# Insights

Insights should primarily appear alongside the communication they describe.

Example:

```text
Conversation

    ├── Messages
    ├── Documents
    └── Insights
```

A dedicated Insights area may be useful for users who want a broader overview of their communications.

However, Insights should not become the centre of the application.

The email remains the primary object.

---

# Security

Security should primarily be configured where the user is creating or reviewing communication.

Example:

```text
Compose

    ↓

Security

    ↓

Choose Protection
```

Security settings may also exist within Identity or account settings.

Security should not require users to navigate to a separate security application before sending an email.

---

# Identity

Identity management is important but is not normally an everyday email activity.

Therefore, identities should generally be accessible through:

```text
Account

    ↓

Identities
```

rather than occupying the same visual priority as Unified, Inbox, or Compose.

Identity management may include:

```text
Email Address

Display Name

Mailbox Connection

Credential Health

Security Associations
```

---

# Credential Health

Credential Health should appear within the Identity experience.

Example:

```text
Identities

    ↓

Work
john@company.com

    ↓

Credential Health
Healthy
```

When attention is required:

```text
Credential Health
Needs Attention

[ Update Credential ]
```

Credential Health should not normally become a top-level navigation item.

The user cares about the health of an email account, not about a separate credential subsystem.

---

# Settings

Settings provide access to configuration that does not belong in the normal email workflow.

Potential areas include:

```text
Account

Identities

Templates

Security

Preferences

Advanced Settings
```

Settings should not become the place where normal email functionality is hidden.

---

# Primary vs Secondary Navigation

The distinction should remain clear.

## Primary

Everyday email activities:

```text
Unified

Inbox

Sent

Drafts

Conversations

Compose
```

## Contextual

Capabilities used while working with an email:

```text
Templates

Documents

Security

Insights
```

## Secondary / Management

Configuration and administration:

```text
Identities

Credential Health

Template Management

Security Configuration

Preferences

Advanced Settings
```

---

# Proposed Navigation Model

A possible initial structure:

```text
MAIL

Unified
Inbox
Sent
Drafts
Conversations

[ Compose ]

────────────────

ACCOUNT

Identities
Settings
```

Contextual capabilities remain accessible from the relevant workspaces:

```text
Compose
    ├── Templates
    ├── Documents
    └── Security

Message / Conversation
    ├── Documents
    └── Insights
```

This is intentionally simpler than placing every Sendity capability into the sidebar.

---

# Navigation Should Reflect Frequency

Navigation priority should generally correspond to how frequently the user performs the task.

High-frequency:

```text
Unified
Inbox
Compose
Sent
Drafts
Conversations
```

Lower-frequency:

```text
Templates
Documents
Insights
```

Configuration:

```text
Identities
Settings
Security Configuration
```

This helps keep the primary interface focused.

---

# Contextual Navigation

The application should allow users to discover related capabilities without requiring global navigation.

For example:

```text
Email
  |
  ├── Documents
  ├── Security
  └── Insights
```

and:

```text
Compose
  |
  ├── Templates
  ├── Documents
  └── Security
```

This is preferable to forcing the user to navigate away from the task.

---

# Example: Sending an Invoice

A user wants to send an invoice.

The experience should be:

```text
Compose
    |
    ▼
Choose sending identity
    |
    ▼
Choose recipient
    |
    ▼
Optional Invoice Message Template
    |
    ▼
Optional Invoice Settings Template
    |
    ▼
Add Invoice Document
    |
    ▼
Review
    |
    ▼
Send
```

The user should not need to navigate:

```text
Templates
    ↓
Documents
    ↓
Security
    ↓
Insights
    ↓
Compose
```

to accomplish the same task.

---

# Example: Simple Email

A simple email should remain extremely simple.

```text
Unified

    ↓

Compose

    ↓

From

    ↓

To

    ↓

Subject

    ↓

Message

    ↓

Send
```

No templates.

No settings.

No security configuration.

No document controls.

No additional decisions.

Unless the user chooses them.

---

# Optional Does Not Mean Hidden

Contextual features must remain discoverable.

For example:

```text
Compose

From:
To:
Subject:

Message

[ Templates ]

[ Add Document ]

[ Security ]

[ Send ]
```

The controls should be visible enough to communicate that additional capabilities exist.

However, they should not overpower:

```text
From

To

Subject

Message

Send
```

Optional functionality should be easy to discover without becoming mandatory.

---

# Progressive Disclosure

The shell should support progressive disclosure.

Example:

```text
Compose
```

shows the essential experience.

The user can then choose:

```text
Templates
```

which reveals:

```text
Message Templates
Settings Templates
```

Choosing a settings template may reveal:

```text
Communication
Document Control
Security
```

The user discovers complexity when it becomes relevant.

---

# Navigation State

The shell should clearly communicate where the user currently is.

Examples:

```text
Unified
  active

Inbox
  inactive

Sent
  inactive

Drafts
  inactive
```

The current destination should be visually identifiable.

The exact visual treatment belongs to the visual design stage.

---

# Conversation Context

When the user opens a conversation, the shell should not make the conversation feel like an unrelated application.

The navigation remains stable while the main workspace changes.

```text
Primary Navigation

        |

        ▼

Conversation Workspace
```

The user should always understand:

```text
Where am I?

What am I viewing?

What can I do next?
```

---

# Responsive Behaviour

The shell must work across:

```text
Desktop

Tablet

Mobile
```

The navigation model should remain conceptually consistent even when its presentation changes.

For example:

```text
Desktop
Sidebar
```

may become:

```text
Mobile
Navigation Drawer / Bottom Navigation
```

The implementation should not be designed independently for each platform.

The underlying information hierarchy should remain consistent.

---

# Desktop

On desktop, a persistent navigation area may be appropriate.

Example:

```text
┌──────────────┬───────────────────────────┐
│ Navigation   │ Main Workspace            │
│              │                           │
│ Unified      │                           │
│ Inbox        │                           │
│ Sent         │                           │
│ Drafts       │                           │
│ Conversations│                           │
│              │                           │
│ Compose      │                           │
│              │                           │
│ Account      │                           │
└──────────────┴───────────────────────────┘
```

Search may remain available in the header or workspace.

---

# Mobile

On mobile, the same hierarchy may be presented through:

```text
Top navigation

Search

Navigation drawer

Bottom navigation

Contextual actions
```

The final choice belongs to the UI design stage.

The important requirement is that essential actions remain easy to access.

---

# Shell And Accessibility

The shell must support accessible navigation.

Requirements include:

- keyboard navigation
- visible focus states
- semantic navigation landmarks
- accessible labels
- sufficient contrast
- predictable interaction
- screen-reader compatibility

Accessibility should be considered from the beginning rather than added after visual design.

---

# Shell And Notifications

Notifications should communicate useful information without becoming intrusive.

Examples:

```text
Email sent

Credential needs attention

Document expired

New message received
```

Notifications should provide a path to the relevant context.

For example:

```text
Credential needs attention

[ Review Identity ]
```

rather than merely displaying an error with no recovery path.

---

# Shell And Errors

Errors should be surfaced close to the task that caused them.

For example:

```text
Compose
    |
    ▼
Send
    |
    ▼
Authentication Failure
```

The user should not suddenly be redirected to a technical error page.

Where recovery is possible, the relevant action should be immediately available.

---

# Shell And User Identity

The current user/account identity should be accessible from the header or account area.

However, the application should distinguish between:

```text
Current User

Identities

Mailboxes
```

These are related but not necessarily the same concept.

A person may manage multiple email identities.

---

# Multiple Identities

A user may have:

```text
Personal
alex@gmail.com

Work
alex@company.com

Finance
accounts@company.com
```

The shell should allow the user to understand which Identity is currently being used when that distinction matters.

Identity selection should not become a constant interruption.

---

# Unified Mailbox And Multiple Identities

The Unified Mailbox should allow multiple identities to participate in one email experience.

For example:

```text
Unified

    ├── Personal
    ├── Work
    └── Finance
```

The user may view all communication together while still being able to filter or switch to an individual identity.

The unified view should never remove the user's ability to understand where a message belongs.

---

# Current Identity Context

Where an action depends on the Identity being used, the UI should make that context clear.

For example:

```text
Compose

From:
alex@company.com
```

The user should be able to change the sending Identity when appropriate.

The application should never silently send from the wrong Identity.

---

# Shell Design Rules

1. The shell must feel like an email application.
2. Primary navigation should prioritise everyday email activities.
3. Unified Mailbox should provide an aggregated email experience across accessible identities.
4. Individual mailbox views must remain available when users need identity-specific context.
5. Search should be easily accessible from the email experience.
6. Search should operate naturally across the Unified Mailbox.
7. Search should not require users to understand mailbox or storage architecture.
8. Compose should remain a prominent action.
9. Templates should be discoverable from Compose.
10. Documents should primarily be accessed in email context.
11. Insights should primarily be accessed in communication context.
12. Security should primarily be configured in communication context.
13. Identities should generally belong to account-level navigation.
14. Credential Health should belong to Identity.
15. Settings should contain configuration rather than everyday email actions.
16. Advanced capabilities should be discoverable but optional.
17. Optional features must not be hidden or difficult to find.
18. Simple email must remain simple.
19. The shell should not expose technical architecture.
20. Navigation should reflect user frequency and importance.
21. Contextual navigation should reduce unnecessary movement between areas.
22. The shell should maintain a consistent information hierarchy across devices.
23. Accessibility must be considered from the beginning.
24. Errors should remain connected to the task that caused them.
25. Identity context must be clear whenever it affects an action.
26. Unified views must not make message ownership or originating identity ambiguous.
27. Navigation should support the email experience rather than become the product.

---

# What This Document Does Not Define

This document does not define:

- colours
- typography
- icons
- CSS
- exact component dimensions
- animations
- final screen layouts
- PHP implementation
- JavaScript implementation
- framework components
- search indexing implementation
- mailbox aggregation implementation

Those decisions belong to later UI and implementation stages.

---

# Next UI Design Stage

Once the shell is agreed upon, the next stage is to design the primary workspace.

The recommended order is:

```text
UI Shell

    ↓

Unified Mailbox

    ↓

Individual Mailbox

    ↓

Search Experience

    ↓

Conversation

    ↓

Message

    ↓

Compose

    ↓

Templates

    ↓

Documents

    ↓

Insights

    ↓

Identity / Credential Health

    ↓

Security
```

The shell should remain stable while these experiences are designed within it.

---

# Guiding Principle

The Sendity shell should make the application feel smaller than the technology underneath it.

The user should see:

```text
Email

People

Conversations

Documents

Control
```

The user should not see:

```text
Framework

Queue

Transport

Workers

Providers

Lifecycle

Authentication Infrastructure
```

The system may contain all of those things.

The shell should not make the user manage them.

> **Sendity should help users manage their email, not make users manage Sendity.**