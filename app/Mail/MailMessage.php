<?php

declare(strict_types=1);

namespace Sendity\Mail;

class MailMessage
{
    private string $id;

    private MailLifecycle $lifecycle;

    private ?Address $from = null;
    private ?Address $replyTo = null;

    /** @var Address[] */
    private array $to = [];

    /** @var Address[] */
    private array $cc = [];

    /** @var Address[] */
    private array $bcc = [];

    private string $subject = '';

    private ?string $html = null;
    private ?string $text = null;

    /** @var Attachment[] */
    private array $attachments = [];

    /** @var array<string, string> */
    private array $headers = [];

    /**
     * Represents an email message.
     *
     * A MailMessage describes what should be sent.
     * It does not know how the message is delivered.
     */
    public function __construct(
        MessageIdGenerator $idGenerator
    ) {
        $this->id = $idGenerator->generate();

        $this->lifecycle = new MailLifecycle();
    }

    /**
     * Return the Sendity message ID.
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * Return the message lifecycle.
     */
    public function lifecycle(): MailLifecycle
    {
        return $this->lifecycle;
    }

    public function from(string $email, ?string $name = null): self
    {
        $this->from = new Address($email, $name);

        return $this;
    }

    public function replyTo(string $email, ?string $name = null): self
    {
        $this->replyTo = new Address($email, $name);

        return $this;
    }

    public function to(string $email, ?string $name = null): self
    {
        $this->to[] = new Address($email, $name);

        return $this;
    }

    public function cc(string $email, ?string $name = null): self
    {
        $this->cc[] = new Address($email, $name);

        return $this;
    }

    public function bcc(string $email, ?string $name = null): self
    {
        $this->bcc[] = new Address($email, $name);

        return $this;
    }

    public function subject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function html(string $html): self
    {
        $this->html = $html;

        return $this;
    }

    public function text(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function attach(string $path): self
    {
        $this->attachments[] = new Attachment($path);

        return $this;
    }

    public function header(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function getFrom(): ?Address
    {
        return $this->from;
    }

    public function getReplyTo(): ?Address
    {
        return $this->replyTo;
    }

    /**
     * @return Address[]
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @return Address[]
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * @return Address[]
     */
    public function getBcc(): array
    {
        return $this->bcc;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getHtml(): ?string
    {
        return $this->html;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return Attachment[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}