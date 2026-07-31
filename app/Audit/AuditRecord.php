<?php

declare(strict_types=1);

namespace Sendity\Audit;

class AuditRecord
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(
        protected array $data
    ) {
    }


    /**
     * Return the complete audit payload.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return $this->data;
    }


    public function id(): string
    {
        return $this->data['id'];
    }


    public function subject(): string
    {
        return $this->data['subject'] ?? '';
    }


    /**
     * @return array<int, array<string, mixed>>
     */
    public function events(): array
    {
        return $this->data['events'] ?? [];
    }
}