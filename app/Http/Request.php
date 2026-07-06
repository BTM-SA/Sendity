<?php

namespace Sendity\Http;

class Request
{
    public function method(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    public function path(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        return parse_url($uri, PHP_URL_PATH) ?? '/';
    }

    public function query(?string $key = null)
    {
        if ($key === null) {
            return $_GET;
        }

        return $_GET[$key] ?? null;
    }

    public function input(?string $key = null)
    {
        $data = $_POST;

        if ($key === null) {
            return $data;
        }

        return $data[$key] ?? null;
    }

    public function all(): array
    {
        return array_merge($_GET, $_POST);
    }

    public function header(string $key): ?string
    {
        $key = strtoupper(str_replace('-', '_', $key));
        $key = 'HTTP_' . $key;

        return $_SERVER[$key] ?? null;
    }

    public function isMethod(string $method): bool
    {
        return $this->method() === strtoupper($method);
    }

    public function isGet(): bool
    {
        return $this->isMethod('GET');
    }

    public function isPost(): bool
    {
        return $this->isMethod('POST');
    }
}