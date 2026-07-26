<?php

namespace Sendity\Core;

class Config
{
    protected array $items = [];

    public function load(string $name, string $path): void
    {
        $this->items[$name] = require $path;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $segments = explode('.', $key);

        $value = $this->items;

        foreach ($segments as $segment) {
            if (!isset($value[$segment])) {
                return $default;
            }

            $value = $value[$segment];
        }

        return $value;
    }
}