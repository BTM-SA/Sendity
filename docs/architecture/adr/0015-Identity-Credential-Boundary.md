# ADR-0015 — Identity Credential Boundary

## Status

Accepted

---

## Context

Sendity models a mailbox identity separately from the infrastructure used to deliver or access mail.

Mail transport configuration currently contains the technical connection details required by the existing SMTP and IMAP drivers. The domain, however, needs a first-class concept representing the credentials associated with an identity.

The North Star architecture defines the relationship as:

```text
Identity
   ↓
Credential
   ↓
validate
   ↓
Mailbox connection
   ↓
Identity becomes Healthy
```

Without a Credential domain concept, authentication state and ownership remain coupled to transport configuration rather than the identity they belong to.

---

## Problem

Sendity needs to represent the authentication relationship of an identity without making the domain layer depend on SMTP, IMAP, PHPMailer, connection settings, or other transport-specific implementation details.

The framework also needs to distinguish between a credential that has not yet been validated and one whose authentication has succeeded or failed.

---

## Decision

Introduce `Credential` as a domain object under `Sendity\Domain\Identity`.

A Credential:

- belongs to an `Identity`
- records its `AuthenticationMethod`
- records its current `CredentialStatus`
- records when it was created
- records the most recent successful authentication time
- records the most recent failed authentication time

The initial authentication methods are:

- password
- application password
- OAuth

The initial credential statuses are:

- pending
- healthy
- needs attention
- authentication failed

The Credential domain object does **not** contain SMTP or IMAP connection details and does not directly depend on a mail transport implementation.

Authentication infrastructure will use the Credential domain concept without moving transport-specific concerns into the domain layer.

---

## Reasoning

Credentials belong to identities rather than to a particular transport configuration.

Keeping Credential in the domain establishes a stable architectural boundary while allowing SMTP, IMAP, OAuth, and future authentication mechanisms to remain infrastructure concerns.

This also gives Sendity a place to represent authentication health independently from message delivery state.

---

## Consequences

### Positive

- Identity credentials have an explicit domain representation.
- Authentication health can be tracked independently from mail delivery.
- The domain remains independent of PHPMailer and IMAP implementation details.
- Additional authentication mechanisms can be introduced without redesigning Identity.
- Transport infrastructure can evolve independently of the identity model.

### Trade-offs

- Credential introduces another domain concept that must be persisted and managed.
- Authentication infrastructure still needs a separate mechanism for securely storing and resolving actual secrets.
- The first slice does not yet perform credential validation or connect a Credential to SMTP/IMAP drivers.

---

## Related Decisions

- ADR-0007: Mail Transport Abstraction
- ADR-0008: Message Identity
- ADR-0014: Queue Architecture
