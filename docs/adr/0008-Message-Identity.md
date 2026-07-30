# Architecture Decision Record

### ADR-0008: Introduce Sendity Message Identity

> **Status:** Accepted
> **Date:** 2026-07-30

---

## Context

Sendity needs a reliable way to identify messages throughout their lifecycle.

Email providers already provide a standard `Message-ID` header, but that identifier belongs to the mail transport system and cannot represent Sendity-specific concepts such as:

- auditing
- tracking
- policies
- message history
- external integrations

A separate application-level identity is required.

## Decision

Sendity introduces a unique message identity generated when a `MailMessage` is created.

The identity uses the format:
```text
snd_<unique_identifier>
```


This identifier is stored on the message object and added to outgoing emails using:
```text
X-Sendity-ID
```



The standard email `Message-ID` header remains controlled by the mail transport layer.

## Reasoning

Separating Sendity identity from email protocol identity provides:

- consistent tracking across mail providers
- independence from SMTP implementations
- a stable reference for auditing
- future support for Outlook plugins and mobile applications

## Consequences

All Sendity messages now have a lifecycle identity.

Future features can reference messages through the Sendity ID:

- delivery events
- open tracking
- policy enforcement
- mailbox synchronisation
- audit records

The application must ensure that message creation always receives a valid identity generator.