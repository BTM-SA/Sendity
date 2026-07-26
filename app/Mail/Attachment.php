<?php

declare(strict_types=1);

namespace Sendity\Mail;

class Attachment
{
    public function __construct(
        private string $path,
        private ?string $name = null,
        private ?string $mimeType = null
    ) {
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function hasName(): bool
    {
        return $this->name !== null && $this->name !== '';
    }

    public function hasMimeType(): bool
    {
        return $this->mimeType !== null && $this->mimeType !== '';
    }
}