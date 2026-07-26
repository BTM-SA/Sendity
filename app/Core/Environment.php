<?php

declare(strict_types=1);

namespace Sendity\Core;

class Environment
{
    protected array $variables = [];

    public function load(string $path): void
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {

    $line = trim($line);

    if ($line === '' || str_starts_with($line, '#')) {
        continue;
    }

    if (!str_contains($line, '=')) {
        continue;
    }

    [$key, $value] = explode('=', $line, 2);

    $this->variables[trim($key)] = trim($value);
}
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->variables[$key] ?? $default;
    }
}