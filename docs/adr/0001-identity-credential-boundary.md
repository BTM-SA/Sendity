# ADR 0001: Identity and Credential Boundary

## Status

Accepted

## Problem

Sendity's mail transports currently obtain SMTP and IMAP authentication details from technical configuration. The Identity workflow requires credentials to belong to an Identity and support authentication health without coupling the domain to SMTP, IMAP, OAuth, or credential-storage implementations.

## Decision

Introduce `Credential` as an Identity-domain concept.

A Credential:

- belongs to an `Identity`
- identifies an authentication method
- exposes a domain-level health state
- records authentication success and failure timestamps
- does not contain SMTP, IMAP, OAuth, PHPMailer, or other transport-specific implementation details
- does not define how secrets are stored or protected

Authentication methods are represented by `AuthenticationMethod`, while credential health is represented by `CredentialStatus`.

## Reasoning

This preserves the existing transport boundary while establishing the domain relationship required by the Identity workflow:

```text
Identity
   |
   +-- Credential
          |
          +-- authentication method
          +-- health
          +-- authentication history
```

Transport implementations can consume credentials through an infrastructure boundary later without making the Identity domain aware of transport-specific mechanisms.

## Consequences

- Credentials can be associated with identities without changing the existing SMTP/IMAP drivers.
- Multiple authentication methods can be supported without changing the Identity concept.
- Credential health can be represented independently from transport implementation details.
- Secret storage and protection remain infrastructure concerns and must be designed separately.
- Mailbox connection and identity health are still separate implementation steps.
