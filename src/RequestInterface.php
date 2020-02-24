<?php

namespace Hpolthof\PostcodeTech;

interface RequestInterface
{
    public function get(string $uri, array $data = []): ResponseInterface;
    public function post(string $uri, array $data = []): ResponseInterface;

    public function request(string $method, string $uri, array $data = []): ResponseInterface;

    public function setHeader(string $name, string $value): RequestInterface;

    public function setBearer(string $token): RequestInterface;
}