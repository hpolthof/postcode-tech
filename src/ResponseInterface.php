<?php

namespace Hpolthof\PostcodeTech;

use Hpolthof\PostcodeTech\Exceptions\HttpException;

interface ResponseInterface
{
    public function setHeaders(array $headers = []): ResponseInterface;

    public function header(string $name, $default = null);

    public function content(): string;

    public function status(): int;

    public function json();

    public function isOk(): bool;

    public function isError(): bool;

    public function getException(): ?HttpException;
}