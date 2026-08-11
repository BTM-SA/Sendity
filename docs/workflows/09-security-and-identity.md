# Sendity Security & Identity Workflow

## Purpose

The Security & Identity workflow describes how Sendity helps users establish trust in an email identity and optionally use security capabilities when sending or receiving email.

Security exists to protect email.

It does not define the email experience.

The workflow should allow users to:

* understand the security state of an identity
* establish or verify identity trust
* manage available security capabilities
* optionally secure an email
* understand when security requirements affect sending
* recover when security cannot be used
* continue using normal email when additional security is not required

---

# Core Principle

Security supports email.

It does not replace email.

The normal experience should remain:

```text
Compose

    ↓

Write

    ↓

Send
```

Security becomes part of the experience when the user chooses or requires it.

The guiding principle is:

> Protect email without making normal email communication unnecessarily difficult.

---

# Identity and Security

An Identity represents an email address through which communication occurs.

Security capabilities belong to identities.

Example:

```text
Identity

alex@example.com

        |

        +── Credentials

        +── Security Settings

        +── Public Keys

        +── Verification State
```

Security should therefore be associated with the identity rather than treated as an isolated technical feature.

---

# Identity Security State

The user should be able to understand the security state of an identity.

For example:

```text
Identity

alex@example.com

Security

Healthy
```

Or:

```text
Identity

alex@example.com

Security

Needs Attention
```

The interface should explain what the state means.

Technical implementation details should remain behind the product experience.

---

# Security Is Optional

Security capabilities should remain optional where appropriate.

A user sending an ordinary email should not be forced to configure:

```text
PGP

Digital Signatures

Identity Verification

Encryption
```

unless the communication requires one of those capabilities.

The normal email workflow remains available.

---

# Choosing Security

When composing an email, the user may choose to apply additional security.

Example:

```text
Compose Email

To:
john@example.com

Subject:
Confidential Information

Message:
...

Security

[ Protect Email ]
```

Selecting the security option allows the user to choose the appropriate protection.

The user should not need to understand cryptographic terminology to make a meaningful decision.

---

# Security Options

Depending on the identities and capabilities involved, Sendity may provide options such as:

```text
Encrypt Email

Sign Email

Verify Recipient

Require Protected Access
```

The available options depend on what Sendity can reliably support for the communication.

Unavailable capabilities should be explained rather than silently ignored.

---

# Encryption

When encryption is selected:

```text
Compose Email

        ↓

Choose Encryption

        ↓

Verify Recipient

        ↓

Review

        ↓

Send
```

Before sending, Sendity should make the security state understandable.

Example:

```text
Encryption

Enabled

Recipient:
John Smith

Encryption:
Available
```

The user should know whether the email can actually be protected before sending.

---

# Digital Signature

A user may optionally sign an email.

Example:

```text
Security

Digital Signature

Enabled
```

The purpose of the signature should be understandable:

> This email is signed using your verified email identity.

The user does not need to understand the underlying signing mechanism.

---

# Identity Verification

Identity verification establishes confidence that a security credential belongs to the intended identity.

The workflow may be:

```text
Identity

    ↓

Verification Required

    ↓

Verify Identity

    ↓

Verification Successful

    ↓

Security Available
```

Verification should be presented as a meaningful user action rather than as a technical configuration task.

---

# Verification State

Possible user-facing states may include:

```text
Verified

Verification Required

Verification Failed

Verification Expired

Needs Attention

Not Available
```

The exact states may evolve.

The important principle is that the user should understand what they can do next.

---

# Verification Failure

If verification fails, Sendity should explain the problem and provide a recovery path.

Avoid:

```text
Verification Error: 0x4921
```

Prefer:

```text
Identity verification failed.

Sendity could not verify this identity.

[ Review Identity ]
```

The system should help the user recover rather than merely report failure.

---

# Credential Health

Credential Health is part of the identity experience.

The user should be able to understand whether the credentials required for email communication are working.

Example:

```text
alex@example.com

Credential Health

Healthy
```

Or:

```text
alex@example.com

Credential Health

Needs Attention

The stored email credential could not authenticate successfully.

[ Update Credential ]
```

This follows the broader Sendity principle that systems should help users recover rather than simply report technical failures.

---

# Credential Failure During Sending

If an email cannot be sent because an identity credential is no longer working:

```text
Compose
    ↓
Send
    ↓
Credential Failure
```

Sendity should explain the problem.

Example:

```text
Email could not be sent.

The email account could not authenticate successfully.

Your stored credential may need to be updated.

[ Update Credential ]
```

The user should not be expected to diagnose SMTP authentication themselves.

---

# Recovering Identity Credentials

The recovery workflow should be:

```text
Credential Failure

        ↓

Explain Problem

        ↓

Update Credential

        ↓

Test Credential

        ↓

Credential Healthy

        ↓

Continue Email
```

The user should receive confirmation when recovery succeeds.

Example:

```text
Credential Updated

Your email identity is working correctly.

[ Continue ]
```

---

# Security Requirements

Some communications may require additional security because of the user's selected settings or policy.

For example:

```text
Confidential Email

Security Required

Encryption must be enabled before this email can be sent.
```

In this situation, Sendity may prevent sending until the requirement is satisfied.

This is different from making security mandatory for every email.

The requirement exists because the user or applicable policy explicitly chose it.

---

# Security Policy

Security requirements may originate from:

```text
User Choice

Settings Template

Policy

Document Protection

Organisation Rules
```

Example:

```text
Confidential Settings

        ↓

Encryption Required

        ↓

New Email

        ↓

Security Requirement
```

The user should be able to understand why the requirement exists.

---

# Security and Templates

Settings Templates may contain security settings.

Example:

```text
Confidential Settings Template

Security
────────────────
Encryption: Enabled
Digital Signature: Enabled
Identity Verification: Required
```

Applying the template creates the starting security configuration for the new email.

The user may modify the settings where permitted.

The template itself is not modified.

---

# Security and Message Templates

A Message Template may optionally be associated with security settings.

Example:

```text
Confidential Message Template

        +

Confidential Settings Template
```

The relationship is optional.

The user may instead:

```text
Use Message Template only
```

or:

```text
Use Settings Template only
```

or:

```text
Use neither
```

This follows the same independence established in the Templates workflow.

---

# Security and Documents

Documents may have additional security requirements.

For example:

```text
Protected Document

        ↓

Encryption

        ↓

Controlled Access
```

Document security should remain connected to the Document Protection workflow.

A user should not need to understand the underlying encryption implementation.

They need to understand what protection has been applied.

---

# Protected Document Access

When a recipient accesses a protected document:

```text
Recipient

    ↓

Identity / Access Check

    ↓
    
Verification

    ↓

Protected Document

    ↓

Allowed Action
```

The recipient should only be asked for the security steps necessary to satisfy the protection configured by the sender.

---

# Recipient Verification

When an email requires a verified recipient identity:

```text
Send Email

        ↓

Recipient Verification Required

        ↓

Verify Recipient

        ↓

Verification Successful

        ↓

Send
```

If verification is unavailable:

```text
Recipient verification could not be completed.

The email has not been sent.

[ Review Security ]
```

The sender remains in control of what happens next.

---

# Sending Without Additional Security

If no additional security is required:

```text
Compose

    ↓

Write

    ↓

Send
```

No security configuration is necessary.

This must remain a first-class Sendity experience.

---

# Security Review Before Sending

When additional security is being used, the user should have an understandable review step.

Example:

```text
Security Review

Recipient
John Smith

Encryption
Enabled

Digital Signature
Enabled

Identity Verification
Verified

Protected Documents
Enabled

[ Send Securely ]
```

The purpose is confirmation.

It should not become a technical diagnostic screen.

---

# Security State After Sending

Once an email is sent, its resulting security state should remain historically meaningful.

Example:

```text
Email Sent

Security

Encrypted
Signed
Recipient Verified
```

Changing a reusable settings template later must not change the security state of the previously sent email.

The sent email represents the security configuration that actually applied when it was created.

---

# Security Snapshot

The resulting workflow is:

```text
Security Template / User Choice

        ↓

User Modifications

        ↓

Final Security Configuration

        ↓

Security Snapshot

        ↓

Sent Email
```

This follows the same snapshot principle used by policies and settings.

---

# Security Failure

Security functionality should not silently fail.

If the user selected encryption and encryption cannot be applied, Sendity should clearly explain the situation.

Example:

```text
Email could not be secured.

Encryption is required for this email, but a suitable encryption method is not currently available.

[ Review Security ]
```

The system must not imply that the email was protected when it was not.

---

# Optional Security Failure

If security was optional rather than required, Sendity may provide the user with a choice.

Example:

```text
Encryption is currently unavailable.

Your email can still be sent without encryption.

[ Send Without Encryption ]

[ Cancel ]
```

The user makes the decision.

Sendity should not silently downgrade security.

---

# Required Security Failure

If security was explicitly required:

```text
Encryption Required

This email cannot be sent without encryption.

[ Review Security ]
```

The communication remains blocked until the requirement is satisfied or the user changes the applicable configuration where permitted.

---

# Security and Insights

Security activity should not become surveillance.

Insights may communicate meaningful security outcomes where appropriate.

For example:

```text
Email Protected

Recipient Verified

Document Access Protected
```

The user should not see internal security events such as:

```text
Key Lookup Event

Encryption Handler Event

Verification API Event
```

Security outcomes belong in the product experience.

Implementation events do not.

---

# Security and Conversations

Security belongs to individual email interactions while conversations provide the broader context.

Example:

```text
Conversation

    ↓

Message 1
Normal Email

    ↓

Message 2
Encrypted Email

    ↓

Message 3
Signed + Encrypted Email
```

A conversation may therefore contain messages with different security states.

Security configuration should not automatically change every message in the conversation unless the user explicitly chooses that behaviour.

---

# Security and Identity Trust

Trust is associated with identities.

Example:

```text
Identity

alex@example.com

        ↓

Verified

        ↓

Trusted Security Credentials
```

If the identity's security state changes, Sendity should make the change understandable.

For example:

```text
Security State Changed

Your identity's encryption credentials require attention.

[ Review Identity ]
```

---

# Security Recovery

The general recovery workflow is:

```text
Security Problem
        ↓
Explain Problem
        ↓
Identify Required Action
        ↓
User Resolves Problem
        ↓
Verify Resolution
        ↓
Continue Email
```

The goal is recovery.

Not merely error reporting.

---

# Security Language

Prefer:

```text
Protected

Encrypted

Signed

Verified

Identity Verified

Security Healthy

Needs Attention

Security Required
```

Avoid exposing implementation language such as:

```text
PGP Packet

Keyring Error

Cipher Failure

Encryption Handler

Cryptographic Exception
```

Technical information may exist in diagnostics for administrators or developers, but it should not become normal user-facing language.

---

# User Control

The user should remain in control of optional security.

Sendity should clearly distinguish between:

```text
Optional

Recommended

Required
```

These are different states.

For example:

```text
Encryption

Optional
```

means the user can choose whether to use it.

```text
Encryption

Recommended
```

means Sendity can encourage its use without blocking the email.

```text
Encryption

Required
```

means the email cannot be sent without satisfying the requirement.

---

# No Silent Downgrades

Sendity must never silently remove a security capability that the user explicitly required.

For example:

```text
User selected:

Encryption Required
```

must not result in:

```text
Email Sent

Encryption unavailable
```

Instead:

```text
Email Not Sent

Encryption could not be applied.

[ Review Security ]
```

The sender must know what happened.

---

# Normal Email Remains Simple

A user who does not need additional security should not have to navigate security screens.

The default workflow remains:

```text
Compose

    ↓

Write

    ↓

Send
```

Security becomes visible when:

* the user chooses it
* a template applies it
* a policy requires it
* the identity requires attention
* the communication requires protection

---

# Core Workflow

The general security workflow is:

```text
Identity
    ↓
Security State
    ↓
Optional Security Choice
    ↓
Security Review
    ↓
Send
    ↓
Protected Email
```

When verification is required:

```text
Identity
    ↓
Verify
    ↓
Security Available
    ↓
Compose
    ↓
Review
    ↓
Send
```

When credentials need attention:

```text
Credential Problem
    ↓
Explain
    ↓
Update Credential
    ↓
Test
    ↓
Healthy
    ↓
Continue Email
```

---

# Secure Email Workflow

```text
Compose Email
      ↓
Choose Security
      ↓
Select Protection
      ↓
Verify Identity / Recipient
      ↓
Security Review
      ↓
Send
      ↓
Protected Email
```

---

# Security Failure Workflow

```text
Security Failure
      ↓
Explain What Happened
      ↓
Determine Whether Security Is Required
      |
      +───────────────+
      |               |
      ▼               ▼
   Optional        Required
      |               |
      ▼               ▼
User Chooses      Cannot Send
      |               |
      ▼               ▼
Continue          Review Security
```

---

# Relationship With Other Workflows

### Identity

Identity establishes the email endpoint and its trust state.

```text
Identity
    ↓
Security State
```

### Credential Health

Credential Health determines whether the identity can reliably authenticate.

```text
Credential Health
    ↓
Reliable Email
```

### Send Email

Security may become part of the send process when selected or required.

```text
Compose
    ↓
Security
    ↓
Send
```

### Templates

Settings Templates may provide reusable security configuration.

```text
Settings Template
    ↓
Security Settings
```

### Document Protection

Documents may use additional security controls.

```text
Document
    ↓
Protection
    ↓
Security
```

### Communication Insights

Insights may communicate meaningful security outcomes.

```text
Protected
Verified
Viewed
```

---

# Workflow Rules

1. Security supports email rather than defining it.
2. Security should remain optional where appropriate.
3. Normal email must remain simple.
4. Users should understand security outcomes without understanding cryptographic implementation.
5. Identity is the foundation for security trust.
6. Security capabilities belong to identities.
7. Credentials belong to identities.
8. Identity verification should produce an understandable trust state.
9. Credential failures should provide a recovery path.
10. Security requirements should be clearly distinguished from optional capabilities.
11. User-selected security must not be silently removed.
12. Sendity must never silently downgrade required security.
13. Optional security failures may allow the user to choose how to proceed.
14. Required security failures must prevent sending until the requirement is satisfied or legitimately changed.
15. Security configuration may originate from user choice, templates, or policies.
16. Security configuration may be modified for an individual email where permitted.
17. Sent emails must preserve the security state that actually applied when they were created.
18. Changing a reusable settings template must not change previously sent emails.
19. Document security must remain compatible with the Document Protection workflow.
20. Security outcomes may appear as meaningful Insights.
21. Technical security events should not become normal product language.
22. Security should not become surveillance.
23. The sender should understand why a security requirement exists.
24. Recipients should only be asked to complete security steps necessary for the protection applied.
25. Security failures should help users recover rather than merely report errors.
26. A conversation may contain messages with different security states.
27. Security should not silently propagate from one message to another.
28. Security should protect sender intent.
29. The simplest email should remain simple.
30. Advanced security should be easy to discover without becoming intrusive.

---

# Guiding Principle

Security should make the user's email **more trustworthy**, not more complicated.

The user should be able to understand:

```text
Who am I?

Is my identity healthy?

Is this email protected?

Is the recipient verified?

What happens if security cannot be applied?
```

without needing to understand the technology underneath.

> **Protect the email. Preserve the user's control. Explain what matters.**
