# Sendity Credential Health Workflow

## Overview

Sendity allows an Identity to use stored credentials when connecting to an external email service.

Credentials exist to allow Sendity to communicate on behalf of an Identity.

The user should not need to understand SMTP authentication, connection protocols, or credential-handling internals.

The important question is:

> **Can Sendity currently communicate successfully using this Identity's stored credential?**

Credential Health provides the answer.

---

# Purpose

Credential Health exists to give users a clear understanding of whether the currently stored credential is working.

It should help users:

- know whether an email account is currently usable
- understand when authentication last succeeded
- understand when authentication last failed
- identify when a stored credential needs attention
- update a credential when necessary
- recover from authentication failures without needing to understand technical protocols

---

# Core Principle

Credentials are infrastructure.

Credential Health is a user experience.

The system may internally deal with:

```text
SMTP

IMAP

Authentication

Connection Errors

Authentication Responses

Transport Errors
```

The user should instead see:

```text
Healthy

Needs Attention

Authentication Failed

Credential Updated

Last Successful Authentication
```

Technical implementation details should not become product language unless they are useful for resolving a problem.

---

# Credential Relationship

Credentials belong to an Identity.

```text
Identity
    |
    ▼
Email Account
    |
    ▼
Stored Credential
    |
    ▼
Credential Health
```

An Identity may have one current credential for a particular external email account.

---

# Current Credential

Sendity should retain the **current working credential** for an email account.

The normal model is:

```text
Current Credential
        |
        ▼
Credential Health
```

When the user replaces a credential, the newly supplied credential becomes the current credential after successful authentication.

---

# Credential History

Sendity does not need to maintain a readable history of previous passwords.

The user primarily needs to know:

> **Which credential is currently working?**

Previous credentials should not become part of the normal user experience.

If credential history is ever required for security or auditing purposes, it should remain an internal security concern rather than a user-facing password history.

---

# Credential Health States

Credential Health should have clear user-facing states.

The exact state model may evolve, but the core states are:

```text
Healthy

Needs Attention

Authentication Failed
```

---

# Healthy

A credential is considered healthy when Sendity has successfully authenticated using the current credential.

The user may see:

```text
Credential Healthy

Last authenticated:
4 Aug 2026 15:42
```

The exact wording may change during UI design.

The important information is:

- the credential currently works
- when Sendity last confirmed that it worked

---

# Needs Attention

A credential may enter a Needs Attention state when Sendity cannot currently confirm that it is usable, but there is not enough information to conclude that the credential itself is invalid.

Examples may include:

```text
Temporary connection failure

External service unavailable

Network failure

Authentication service temporarily unavailable
```

The user should not be told that their password is incorrect when Sendity does not actually know that.

Example:

```text
Email account needs attention.

Sendity could not currently verify the account connection.

Last successful authentication:
4 Aug 2026 15:42
```

---

# Authentication Failed

When the external email service explicitly rejects the current credential, Sendity should communicate that clearly.

Example:

```text
SMTP authentication failed.

The currently stored credential has not authenticated successfully since:

4 Aug 2026 15:42

Would you like to update it?
```

The wording should remain understandable to the user.

---

# Last Successful Authentication

Credential Health should retain the time at which the current credential was last known to authenticate successfully.

Example:

```text
Last successful authentication:

4 Aug 2026 15:42
```

This provides useful context when something later fails.

For example:

```text
Credential Health

Needs Attention

Last successful authentication:
4 Aug 2026 15:42
```

The user can therefore understand that the account was working previously.

---

# Last Failed Authentication

Sendity may also record the most recent unsuccessful authentication attempt.

Example:

```text
Last authentication failure:

6 Aug 2026 09:17
```

This information should be presented only when it helps the user understand the current state.

---

# Health Is About the Current Credential

Credential Health describes the relationship between:

```text
Identity

        +

Current Credential

        +

External Email Service
```

It does not simply describe whether the email address exists.

An Identity may exist and remain valid while its current credential is no longer accepted.

---

# Credential Update Workflow

When authentication fails and the failure indicates that the credential is invalid, Sendity should provide a straightforward recovery path.

```text
Authentication Failed
        |
        ▼
Explain Problem
        |
        ▼
Offer Credential Update
        |
        ▼
User Enters New Credential
        |
        ▼
Sendity Tests Credential
        |
        +----------------+
        |                |
        ▼                ▼
     Success          Failure
        |                |
        ▼                ▼
Credential Healthy   Explain Failure
```

---

# Updating a Credential

The user should be able to replace the current credential.

The process should be simple:

```text
Update Credential

        ↓

Enter New Password

        ↓

Verify

        ↓

Authenticate

        ↓

Credential Healthy
```

The password should be protected while being entered.

---

# Password Visibility

Passwords should be hidden by default.

The user may temporarily reveal the password when needed.

Example:

```text
Password
[••••••••••••]  [Show]
```

After revealing:

```text
Password
[my-password]   [Hide]
```

Visibility should be a user-controlled convenience.

It must not cause the password to become permanently visible.

---

# Credential Verification

When a new credential is supplied, Sendity should attempt to verify it before treating it as the current working credential.

The process is:

```text
New Credential

        ↓

Authentication Test

        ↓

Success
    |
    ▼
Current Credential Updated
    |
    ▼
Health = Healthy
```

A failed verification should not silently replace a known working credential.

---

# Failed Credential Update

If the new credential fails authentication:

```text
Authentication Failed

The new credential could not be authenticated.

The existing credential has not been replaced.
```

This protects the user from accidentally replacing a working credential with an invalid one.

---

# Successful Credential Update

If the new credential authenticates successfully:

```text
Credential Updated

The new credential has authenticated successfully.

Credential Health:
Healthy
```

The new credential becomes the current credential.

---

# Re-Authentication

Sendity may periodically test the current credential when appropriate.

For example:

```text
Current Credential
        |
        ▼
Authentication Test
        |
        +── Success → Healthy
        |
        +── Temporary Failure → Needs Attention
        |
        +── Rejected → Authentication Failed
```

The exact frequency and mechanism belong to the technical architecture.

The workflow only defines the user-facing outcome.

---

# Sending Email With an Unhealthy Credential

If the user attempts to send an email using an Identity whose credential is known to be invalid, Sendity should not simply present:

```text
Authentication failed.
```

Instead, the user should receive useful context.

Example:

```text
Email could not be sent.

SMTP authentication failed.

The currently stored credential has not authenticated successfully since:

4 Aug 2026 15:42

[Update Credential]
```

The user should understand:

1. the email was not sent
2. why Sendity could not send it
3. when the credential last worked
4. what they can do next

---

# Temporary Failure

Not every connection failure means that the password is wrong.

For example:

```text
Email service temporarily unavailable.
```

or:

```text
Sendity could not connect to the email service.

Your stored credential has not been changed.
```

The system should avoid asking the user to change their password unnecessarily.

---

# Credential Health And Identity

Credential Health should appear as part of the Identity experience.

Example:

```text
Identity

john@example.com

Credential
    Healthy

Last authenticated
    4 Aug 2026 15:42
```

If there is a problem:

```text
Identity

john@example.com

Credential
    Needs Attention

Last successful authentication
    4 Aug 2026 15:42

[Update Credential]
```

This keeps the user experience centred around the email account rather than the underlying transport system.

---

# Multiple Identities

A user may have multiple identities.

For example:

```text
Personal
    alex@gmail.com
    Healthy


Work
    alex@company.com
    Healthy


Finance
    accounts@company.com
    Needs Attention
```

Credential Health belongs to the relevant Identity.

A problem with one Identity must not make unrelated identities appear unhealthy.

---

# Security

Credentials are sensitive security information.

Sendity must protect stored credentials.

The user-facing workflow should never expose:

- stored passwords
- previous passwords
- authentication tokens
- connection secrets
- raw authentication responses

Credential Health should expose only the information necessary to understand and resolve the account's state.

---

# Credential Health And Insights

Credential Health is not an Insight.

It is an account health state.

For example:

```text
Credential Health
    Healthy
```

is different from:

```text
Insight
    Message Viewed
```

Credential Health describes whether Sendity can operate using an Identity.

Insights describe what happened to communication.

---

# Credential Health And Email Delivery

Credential Health supports email delivery but does not represent delivery itself.

The relationship is:

```text
Identity
    |
    ▼
Credential Health
    |
    ▼
Send Email
    |
    ▼
Delivery
    |
    ▼
Communication Insight
```

Credential Health answers:

> Can Sendity currently authenticate as this Identity?

Delivery answers:

> Was the email successfully delivered?

These are separate concerns.

---

# User Experience Principles

## Clear

Users should immediately understand whether an email account is usable.

---

## Honest

Sendity should never claim that a password is invalid unless the external service has actually rejected it.

---

## Recoverable

When a credential fails, the user should have a clear path to update it.

---

## Non-Destructive

A failed credential replacement should not destroy a known working credential.

---

## Secure

Credentials must remain protected throughout the workflow.

---

## Simple

Users should not need to understand SMTP, IMAP, authentication protocols, or connection infrastructure.

---

# Language Rules

Prefer:

```text
Credential Healthy

Needs Attention

Authentication Failed

Credential Updated

Last successful authentication

Update Credential
```

Avoid exposing unnecessary technical terminology such as:

```text
SMTP AUTH failure code 535

IMAP LOGIN rejected

TransportException

Authentication mechanism LOGIN failed
```

Technical information may be available to administrators or diagnostic tools where appropriate, but it should not become the ordinary user experience.

---

# Technical Boundaries

This workflow does not define:

- password hashing or encryption implementation
- credential storage mechanism
- SMTP implementation
- IMAP implementation
- authentication protocols
- connection retry implementation
- credential testing frequency
- background health checks
- transport-specific error handling

Those belong to the technical architecture.

The workflow defines the user-facing behaviour.

---

# Design Rules

1. Credentials belong to Identities.
2. Credential Health describes whether the current credential can currently authenticate.
3. Credential Health is a user-facing account health state.
4. The current working credential is the credential that should normally be retained.
5. Previous passwords should not be exposed as a user-facing password history.
6. Passwords are hidden by default.
7. Users may temporarily reveal a password when necessary.
8. A new credential should be authenticated before replacing a known working credential.
9. A failed credential update must not silently replace a known working credential.
10. Explicit authentication rejection should be presented as Authentication Failed.
11. Temporary connection failures should not automatically be treated as invalid credentials.
12. Credential Health should provide the last successful authentication time where useful.
13. Credential Health may provide the most recent failure time where useful.
14. Credential Health belongs to the relevant Identity.
15. An unhealthy Identity must not affect unrelated Identities.
16. Credential Health is separate from email delivery status.
17. Credential Health is separate from communication Insights.
18. Credential problems should provide a clear recovery path.
19. Technical authentication details should not become ordinary product language.
20. Credentials must remain protected throughout the workflow.
21. Users should be able to understand and recover from credential problems without understanding transport protocols.

---

# Guiding Principle

Credential Health should answer one simple question:

> **"Can Sendity currently use this email account?"**

If the answer is yes, the user should be able to trust that the account is ready.

If the answer is no, Sendity should explain what it knows, avoid making assumptions, and provide the simplest possible path to recovery.

The technology may be complex.

The user's experience should not be.