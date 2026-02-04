<?php

namespace Framework;

class Response
{
    public int $responseCode;

    public string $body;

    public ?string $headers;

    public function __construct(string $body = '', ?string $headers = null, int $responseCode = 200)
    {
        $this->responseCode = $responseCode;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function echo(): void {
        if ($this->headers !== null) {
            header($this->headers);
        }
        http_response_code($this->responseCode);
        echo $this->body;
    }
}