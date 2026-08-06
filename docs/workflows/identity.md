# Sendity Identity Workflow

## Overview

The Identity workflow describes how an email identity becomes available and reliable within Sendity.

An Identity represents the email address through which a user sends and receives email.

Identity is one of the foundations of the Sendity domain.

Without a healthy identity, email communication cannot function reliably.

---

# Goal

The goal of the Identity workflow is:

> Allow a user to connect, manage, and maintain a trusted email identity within Sendity.

---

# Domain Concepts Involved

This workflow involves:

```
Identity

Credential

Mailbox

Security

Insight
```

---

# Identity Principle

One email address = one Identity.

Example:

```
alex@company.com
```

and:

```
alex@gmail.com
```

represent different identities.

Even if they belong to the same person.

---

# Starting Point

A user wants to add an email identity.

The user provides:

```
Email address

Display information

Authentication method
```

Authentication may include:

- password authentication
- application passwords
- OAuth
- future authentication methods

The workflow should support different authentication methods without changing the Identity concept.

---

# Identity Creation Workflow

The process:

```
User adds email address

        |

        ▼

Sendity creates Identity

        |

        ▼

Authentication details provided

        |

        ▼

Credentials validated

        |

        ▼

Mailbox connection established

        |

        ▼

Identity becomes available
```

---

# Identity States

An Identity has a health state.

Possible states:

```
Pending

Healthy

Needs Attention

Authentication Failed

Disconnected

Disabled
```

---

# Pending

## Meaning

The identity exists but has not completed setup.

Example:

```
Identity created

Waiting for authentication
```

---

# Healthy

## Meaning

The identity is working correctly.

The user can:

- send email
- receive email
- access mailbox features

Example:

```
Identity

Status:
Healthy
```

---

# Needs Attention

## Meaning

The identity requires user action.

Examples:

- credential expired
- provider requires reauthentication
- security settings changed

The user should understand:

```
Something needs your attention.
```

Not:

```
Authentication exception detected.
```

---

# Authentication Failure

## Principle

A failure should explain the situation and provide a recovery path.

Avoid:

```
Authentication failed.
```

Prefer:

```
SMTP authentication failed.

The currently stored credential has not authenticated successfully since:

4 Aug 2026 15:42

Would you like to update it?
```

---

# Credential Health

Credentials have their own health state.

A credential should communicate:

```
Working

Last successful authentication

Last failed authentication

Current status
```

Example:

```
Credential Status:

Healthy

Last successful authentication:

4 Aug 2026 14:10
```

---

Failure example:

```
Credential Status:

Needs Attention

Last successful authentication:

4 Aug 2026 15:42

Authentication failures detected.

Would you like to update the credential?
```

---

# Credential Storage Principle

Credentials exist to support email identity reliability.

Credentials should:

- be protected
- only be accessible through appropriate security controls
- support replacement
- maintain health information

The user should only need the current working credential.

Historical passwords should not become a user-facing feature.

---

# Updating Credentials

When credentials fail:

The user should be guided through recovery.

Workflow:

```
Identity requires attention

        |

        ▼

User reviews status

        |

        ▼

User chooses update credential

        |

        ▼

New credential provided

        |

        ▼

Authentication tested

        |

        ▼

Identity returns to Healthy
```

---

# Mailbox Connection

Once authentication succeeds:

```
Identity

        |

        ▼

Mailbox Connection

        |

        ▼

Mailbox Available
```

The mailbox provides access to:

- incoming email
- outgoing email
- conversations
- message history

---

# Security Relationship

Identity connects to security capabilities.

Example:

```
Identity

    |

    +── Encryption Keys

    +── Verification State

    +── Security Settings
```

Security supports identity trust.

---

# Insights

Identity-related events may create insights.

Examples:

```
Identity Connected

Credential Updated

Authentication Failed

Identity Needs Attention
```

Insights should describe outcomes.

They should not expose internal technical events.

---

# Technical Boundaries

This workflow does not define:

- SMTP implementation
- IMAP implementation
- OAuth implementation
- credential storage mechanisms
- encryption implementation

Those belong to technical architecture.

---

# Design Rules

1. One email address represents one Identity.
2. Credentials belong to identities.
3. Identity health must be understandable.
4. Failures should provide recovery paths.
5. Technical errors should become user-understandable states.
6. Identity should support multiple authentication methods.
7. Security should strengthen identity without making normal email usage difficult.

---

# Guiding Principle

An Identity should answer:

> "Can Sendity reliably send and receive email on behalf of this address?"

If the answer changes, Sendity should help the user understand why and what to do next.