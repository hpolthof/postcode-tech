<?php


namespace Hpolthof\PostcodeTech;


use Hpolthof\PostcodeTech\Exceptions\HttpException;

class Response implements ResponseInterface
{
    protected $status;
    protected $headers = [];
    protected $content;

    public function __construct(string $content, $status = 200)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public function setHeaders(array $headers = []): self
    {
        $this->headers = [];

        foreach ($headers as $name => $value) {
            $this->headers[strtolower($name)] = $value;
        }

        return $this;
    }

    public function header(string $name, $default = null)
    {
        return $this->headers[strtolower($name)] ?? $default;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function json()
    {
        if (!$this->header('content-type') == 'application/json')
            return null;

        return json_decode($this->content());
    }

    public function isOk(): bool
    {
        return $this->status() < 300;
    }

    public function isError(): bool
    {
        return $this->status() >= 400;
    }

    public function getException(): ?HttpException
    {
        if (!$this->isError()) {
            return null;
        }

        return (new HttpException("Request responded with HTTP code {$this->status()}."))
            ->setResponse($this);
    }
}