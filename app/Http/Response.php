<?php

namespace Sendity\Http;

class Response
{
    protected array $headers = [];
    protected string $content = '';
    protected int $status = 200;

    public function __construct(string $content = '', int $status = 200)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public static function text(string $content, int $status = 200): self
    {
        return new self($content, $status);
    }

    public static function json(array $data, int $status = 200): self
    {
        $response = new self(json_encode($data), $status);

        $response->header('Content-Type', 'application/json');

        return $response;
    }

    public function header(string $key, string $value): self
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function status(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function send(): void
    {
        http_response_code($this->status);

        foreach ($this->headers as $key => $value) {
            header("{$key}: {$value}");
        }

        echo $this->content;
    }
}