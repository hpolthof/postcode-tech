<?php

declare(strict_types=1);

namespace Hpolthof\PostcodeTech\Http\Request;

final class Headers
{
    /**
     * @var array<string, string>
     */
    private array $headers = [];

    /**
     * @param array<string, string> $headers
     */
    public function __construct(array $headers = [])
    {
        foreach ($headers as $key => $value) {
            $this->addHeader($key, $value);
        }
    }

    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    public function getHeaders(): string
    {
        $headers = '';

        foreach ($this->headers as $key => $value) {
            $headers .=  "{$key}: {$value}\r\n";
        }

        return $headers;
    }
}
