<?php

namespace Hpolthof\PostcodeTech;

class Request implements RequestInterface
{
    private $headers = [];

    public function get(string $uri, array $data = []): ResponseInterface
    {
        return $this->request('GET', $uri, $data);
    }

    public function post(string $uri, array $data = []): ResponseInterface
    {
        return $this->request('POST', $uri, $data);
    }

    public function request(string $method, string $uri, array $data = []): ResponseInterface
    {
        $header = $this->getFormattedHeaders();
        $ignore_errors = true;
        $content = strtoupper($method) !== 'GET' ? http_build_query($data) : '';

        $content = file_get_contents($uri, false, stream_context_create([
            "http" => compact('method', 'header', 'ignore_errors', 'content')
        ]));

        $status = intval(explode(' ', array_shift($http_response_header))[1]);

        $headers = $this->extractHeaders($http_response_header);

        return (new Response($content, $status))
            ->setHeaders($headers);
    }

    public function setHeader(string $name, string $value): RequestInterface
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function setBearer(string $token): RequestInterface
    {
        return $this->setHeader('Authorization', "Bearer {$token}");
    }


    final private function getFormattedHeaders(): string
    {
        $headers = '';
        foreach ($this->headers as $key => $value) {
            $headers .= "{$key}: {$value}\r\n";
        }
        return $headers;
    }

    private function extractHeaders($http_response_header): array
    {
        $headers = [];
        foreach ($http_response_header as $h) {
            $item = explode(': ', $h, 2);
            $headers[$item[0]] = $item[1];
        }

        return $headers;
    }
}