<?php

declare(strict_types=1);

namespace Hpolthof\PostcodeTech\Http\Response;

use Hpolthof\PostcodeTech\Exceptions\HttpException;

final class Response
{
    private readonly Headers $headers;

    /**
     * @param string[] $responseHeaders
     */
    public function __construct(
        private readonly string $responseBody,
        array $responseHeaders,
    ) {
        $this->headers = new Headers($responseHeaders);
    }

    public function getResponseBody(): string
    {
        return $this->responseBody;
    }

    /**
     * @throws HttpException
     *
     * @return array{
     *     street: string,
     *     city: string,
     * }
     */
    public function getResponseBodyAsArray(): array
    {
        try {
            $array = json_decode($this->responseBody, true, flags: JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            throw new HttpException('The response body is not a valid JSON array.', $this->responseBody, $exception);
        }

        if (!is_array($array) || empty($array['street']) || !is_string($array['street']) || empty($array['city']) || !is_string($array['city'])) {
            throw new HttpException('The response body did not contain the expected data.', $this->responseBody);
        }

        return $array;
    }

    public function getHeaders(): Headers
    {
        return $this->headers;
    }

    public function isSuccess(): bool
    {
        $statusCode = $this->headers->getStatusCode();

        return $statusCode >= 200 && $statusCode < 300;
    }
}
