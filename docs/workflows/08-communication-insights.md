# Sendity Communication Insights Workflow

## Purpose

Communication Insights help users understand what happened after an email was sent.

The purpose is not to provide analytics or surveillance.

The purpose is to provide meaningful visibility into communication.

Users should be able to answer questions such as:

```text
Was my email viewed?

Was the document viewed?

Did the recipient interact with the email?

What happened after I sent it?

When did those things happen?
```

The workflow should turn technical communication activity into information that a person can understand.

---

# Core Principle

Sendity does not expose the technical mechanisms used to understand communication.

Users should see:

```text
Message Viewed

Document Viewed

Link Accessed

Recipient Interacted

Communication Timeline
```

Users should not see:

```text
Tracker Hit

Tracking Pixel

Pixel Fired

Tracking Event

Analytics Event
```

The user is interested in the outcome of communication, not the mechanism used to observe it.

---

# Insights Are Optional

Insights are an optional capability.

A user should be able to send a normal email without needing to configure Insights.

Simple email remains simple:

```text
Compose

    ↓

Write Email

    ↓

Send
```

When Insights are available or enabled, the user gains additional visibility without changing the fundamental email experience.

---

# Sending With Insights

When a user sends an email with Insights enabled:

```text
Compose
    ↓
Optional Insights
    ↓
Send
    ↓
Email Delivered
    ↓
Recipient Activity
    ↓
Insights Updated
```

The sender does not need to manually manage individual tracking mechanisms.

Sendity handles the underlying process.

---

# Initial State

Immediately after sending, the sender may see:

```text
Sent

Invoice #4821

Sent
```

The communication timeline can initially show:

```text
Email Sent

No recipient activity yet.
```

The absence of activity should not be presented as an error.

It simply means that Sendity does not yet have an interaction to report.

---

# Delivery

Where delivery information is available, the sender should be able to understand whether the email was successfully delivered.

Example:

```text
Delivered

Your email was delivered to the recipient.
```

If delivery cannot be confirmed:

```text
Delivery Unknown

Sendity could not confirm delivery.
```

The interface should distinguish between:

```text
Delivered

Not Delivered

Delivery Unknown
```

rather than presenting technical transport information.

---

# Message Viewed

When Sendity can determine that the message was viewed, the Insight should be expressed in human language.

Example:

```text
Message Viewed

John viewed this message.
```

Where appropriate, the communication timeline may show:

```text
10:42
Message Sent

11:03
Message Viewed
```

The sender should not be shown the technical event that produced the Insight.

---

# Document Viewed

Documents are first-class communication resources.

If a document included with an email is viewed, the sender should be able to see:

```text
Document Viewed

Invoice.pdf was viewed.
```

The document can appear in the communication timeline:

```text
Message Sent

        ↓

Message Viewed

        ↓

Invoice.pdf Viewed
```

---

# Document Downloaded

If downloading is permitted by the applicable document policy, Sendity may provide an Insight when a document is downloaded.

Example:

```text
Document Downloaded

Invoice.pdf was downloaded.
```

If downloading is disabled by policy, no download should be possible.

The Insight system should therefore respect the document's policy.

---

# Document Printed

If printing is permitted and Sendity can reliably determine that the document was printed, the sender may see:

```text
Document Printed

Invoice.pdf was printed.
```

Printing Insights should follow the same principle as other Insights:

They describe a meaningful communication outcome rather than exposing the technical mechanism.

---

# Link Accessed

Where link Insights are supported, the sender may see:

```text
Link Accessed

The recipient accessed a link in the message.
```

The user-facing language should describe the communication action.

Technical terminology such as tracker or event should remain internal.

---

# Recipient Interaction

Multiple communication activities may be combined into a broader Insight.

Example:

```text
Recipient Interaction

John viewed the message and accessed the invoice.
```

This allows Sendity to provide a meaningful summary rather than forcing users to interpret a collection of low-level events.

---

# Communication Timeline

The Communication Timeline provides the clearest way to understand what happened after sending.

Example:

```text
Communication Timeline

10:42
Message Sent

10:43
Delivered

11:03
Message Viewed

11:04
Invoice.pdf Viewed

11:05
Invoice.pdf Downloaded
```

The timeline should focus on meaningful communication events.

It should not expose implementation-level events.

---

# Timeline Ordering

Events should be presented chronologically.

The sender should be able to understand:

```text
What happened first?

What happened next?

What happened most recently?
```

The timeline should remain understandable even when there are many events.

---

# Multiple Recipients

An email may have multiple recipients.

Insights should make recipient context clear where appropriate.

Example:

```text
Recipients

John Smith
Message Viewed

Sarah Jones
Message Viewed

Accounts Department
Delivered
```

The user should not have to guess which recipient performed an interaction.

---

# Recipient Privacy

Insights should respect recipient privacy and the communication context.

Sendity should avoid presenting unnecessary information.

The purpose is to understand communication, not to collect unrelated information about recipients.

Insights should therefore provide the minimum meaningful information required to understand the communication outcome.

---

# Insight Availability

Not every communication event can necessarily be observed.

The interface should therefore distinguish between:

```text
Confirmed

Unknown

Not Applicable
```

It should not imply certainty where Sendity cannot reliably establish an outcome.

For example:

```text
Message Viewed
```

should only be presented as a confirmed Insight when Sendity has sufficient evidence to support it.

---

# No Activity

If no Insight has been generated, the interface should remain calm and informative.

Example:

```text
No recipient activity yet.

Your message has been sent successfully.
```

It should not imply that the recipient ignored the message.

Lack of observable activity does not necessarily mean lack of activity.

---

# Insights and Document Policies

Document Insights must respect document policies.

For example:

```text
Allow Download
```

may result in:

```text
Document Downloaded
```

Whereas:

```text
Prevent Download
```

means a download should not occur through Sendity's protected document experience.

The Insight workflow therefore works alongside the Document Protection workflow.

---

# Insights and Templates

Settings templates may configure how Insights behave for a category of communication.

For example:

```text
Invoice Settings Template

    ↓

Communication Insights
    ↓
Message Viewed
Document Viewed
Document Downloaded
```

The user does not need to configure individual Insight mechanisms.

They may simply choose an appropriate settings template.

---

# Insights and Message Templates

A Message Template may optionally be associated with a Settings Template.

For example:

```text
Invoice Message Template
        +
Invoice Settings Template
        ↓
New Email
        ↓
Message + Settings
```

The relationship is optional.

A user may instead choose:

```text
Message Template
```

without the associated settings.

Or:

```text
Settings Template
```

without using a pre-styled message.

Or neither.

The Insights workflow must support all of these cases.

---

# Reviewing Insights

The sender should be able to review Insights from the communication itself.

Example:

```text
Sent

Invoice #4821

[ Message ]

[ Documents ]

[ Insights ]
```

Selecting Insights should reveal the communication history.

The user should not need to navigate to a separate analytics system.

---

# Insights Summary

A communication may provide a simple summary before showing the full timeline.

Example:

```text
Insights

Delivered
Viewed
Document Viewed
Downloaded
```

The sender can then open the Communication Timeline for detail.

This allows users to understand the overall outcome quickly.

---

# Recent Activity

The interface may provide a recent activity summary.

Example:

```text
Recent Activity

11:05
Invoice.pdf downloaded

11:04
Invoice.pdf viewed

11:03
Message viewed
```

This can help users quickly determine whether something has changed since they last checked.

---

# Notifications

Insights may optionally generate notifications.

For example:

```text
Invoice #4821

Recipient viewed your message.
```

Notifications should remain useful and controlled.

They should not turn every small interaction into an interruption.

---

# Insight Preferences

Users may be able to control how Insights are presented.

Possible preferences include:

```text
Enable Insights

Show notifications

Show communication timeline

Show document activity
```

These preferences should remain understandable and should not expose technical tracking configuration.

---

# Sending Without Insights

The sender should always be able to send an email without Insights.

Example:

```text
Compose

From:
alex@company.com

To:
john@example.com

Subject:
Hello

Message:
...

[ Send ]
```

There is no requirement to configure Insights.

---

# Sending With Insights

If the user chooses to use Insights:

```text
Compose

From:
alex@company.com

To:
john@example.com

Subject:
Invoice

Message:
...

[ Insights ]

[ Send ]
```

The user can then review the available Insight options.

The normal email fields remain the primary experience.

---

# Insight Failure

If an Insight cannot be generated, the email itself should not fail solely because of the Insight.

Example:

```text
Email Sent

Insights unavailable for this message.
```

The communication should remain independent from optional Insight functionality.

This reflects the principle:

> Communication comes first.

---

# Insight Integrity

Sendity should not claim an outcome that it cannot establish reliably.

For example, an Insight should not say:

```text
Recipient read the email.
```

when Sendity only knows that a technical mechanism was triggered.

Instead, the product language should accurately describe what Sendity can establish.

The distinction between:

```text
Observed

Inferred

Unknown
```

should remain clear internally and, where relevant, in the user experience.

---

# Insight Language

Prefer:

```text
Message Sent

Delivered

Message Viewed

Document Viewed

Document Downloaded

Document Printed

Link Accessed

Recipient Interaction
```

Avoid:

```text
Tracker Hit

Pixel Fired

Tracking Event

Analytics Event

Tracking Request
```

The product should describe communication, not instrumentation.

---

# Insight Privacy

Insights should collect and expose only information necessary to provide meaningful communication visibility.

Sendity should avoid unnecessary recipient profiling.

Insights should not become:

```text
Marketing Analytics

Behavioural Profiling

Surveillance
```

The workflow exists to support trust and communication understanding.

---

# User Control

The sender should remain in control of whether optional Insights are used.

The user should be able to understand:

```text
Insights Enabled
```

or:

```text
Insights Not Enabled
```

without needing to understand the implementation.

The capability should be discoverable without becoming intrusive.

---

# Core Workflow

The general workflow is:

```text
Compose Email
      ↓
Optional Insights
      ↓
Send
      ↓
Delivery
      ↓
Recipient Interaction
      ↓
Communication Insights
      ↓
Communication Timeline
```

---

# Simple Email Workflow

```text
Compose
   ↓
Write
   ↓
Send
```

No Insights configuration is required.

---

# Email With Insights Workflow

```text
Compose
   ↓
Choose Optional Insights
   ↓
Write
   ↓
Send
   ↓
Delivered
   ↓
Message Viewed
   ↓
Document Viewed
   ↓
Document Downloaded
   ↓
Review Timeline
```

Only events that actually occur should appear.

---

# Protected Document Workflow

When a protected document is involved:

```text
Compose
   ↓
Add Document
   ↓
Apply Document Policy
   ↓
Optional Insights
   ↓
Send
   ↓
Recipient Views Document
   ↓
Insight Recorded
```

The Document Protection workflow remains responsible for determining what the recipient is allowed to do.

The Insights workflow describes what actually happened.

---

# Relationship With Other Workflows

Communication Insights connects with several existing workflows.

### Send Email

Insights begin after an email is sent.

```text
Send Email
    ↓
Insights
```

### Receiving Email

Recipient interaction occurs after the email is received.

```text
Send
    ↓
Receive
    ↓
Interact
    ↓
Insight
```

### Conversations

Insights belong to the communication they describe.

```text
Conversation
    ↓
Message
    ↓
Insights
```

### Document Protection

Document policies determine permitted actions.

```text
Document Policy
    ↓
Permitted Actions
    ↓
Document Insights
```

### Templates

Settings templates may configure optional Insight behaviour.

```text
Settings Template
    ↓
Message
    ↓
Insights
```

---

# Workflow Rules

1. Insights exist to improve understanding of communication.
2. Insights are optional.
3. Sending email must not require Insights.
4. Communication must remain independent from optional Insight functionality.
5. Users should see meaningful communication outcomes rather than technical tracking events.
6. Insights should use human-readable language.
7. Insights should not expose implementation terminology.
8. Insights should only claim outcomes that Sendity can reliably establish.
9. Lack of an Insight must not imply that the recipient ignored the communication.
10. Multiple recipient interactions should retain recipient context.
11. Insights should respect recipient privacy.
12. Document Insights must respect document policies.
13. Insights should appear alongside the communication they describe.
14. The Communication Timeline should provide chronological context.
15. Notifications should remain optional and controlled.
16. Insights should not become an analytics or surveillance system.
17. The minimum meaningful information should be preferred over unnecessary data collection.
18. Templates may configure Insight behaviour, but templates are not required.
19. Message Templates and Settings Templates may be used independently.
20. A Message Template may optionally be associated with a Settings Template.
21. Insight failures should not prevent email communication from succeeding.
22. Communication remains the primary product experience.
23. The sender should remain in control of optional Insight capabilities.
24. The UI should clearly communicate whether Insights are being used.
25. Technical implementation details should remain outside the user-facing workflow.

---

# Guiding Principle

The purpose of Communication Insights is not to tell users everything Sendity knows.

It is to tell them **what they meaningfully need to know about their email**.

> **Understand the communication. Don't expose the machinery behind it.**
