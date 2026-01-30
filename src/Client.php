<?php

namespace Hpolthof\PostcodeTech;

use Hpolthof\PostcodeTech\Exceptions\HttpException;
use Hpolthof\PostcodeTech\Exceptions\PostcodeNotFoundException;
use Hpolthof\PostcodeTech\Exceptions\ValidationException;
use Hpolthof\PostcodeTech\Http\Request\Headers;
use Hpolthof\PostcodeTech\Http\Response\Response;

final class Client
{
    /** @var string */
    private const BASE_URI = 'https://postcode.tech';

    private Headers $headers;

    public function __construct(
        private readonly string $token,
    ) {
        $this->headers = new Headers([
            'Authorization' => sprintf('Bearer %s', $this->token),
        ]);
    }

    /**
     * @throws PostcodeNotFoundException
     * @throws ValidationException
     * @throws HttpException
     *
     * @return array{
     *     street: string,
     *     city: string,
     * }
     */
    public function get(string $postcode, int $number): array
    {
        $queryParameters = [
            'postcode' => $postcode,
            'number' => $number,
        ];

        $uri = sprintf(
            '%s/%s?%s',
            self::BASE_URI,
            'api/v1/postcode',
            http_build_query($queryParameters),
        );

        $response = file_get_contents(
            $uri,
            false,
            stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => $this->headers->getHeaders(),
                    'ignore_errors' => true,
                ],
            ]),
        );

        if (!$response) {
            throw new HttpException('No response received from the API.');
        }

        // @todo refactor the magic '$http_response_header' to 'http_get_last_response_headers()' when PHP 8.4 is the lowest supported version.
        $response = new Response($response, $http_response_header);

        if (!$response->isSuccess()) {
            match ($response->getHeaders()->getStatusCode()) {
                404 => throw new PostcodeNotFoundException('No results found for the given postcode and number.', $response->getResponseBody()),
                422 => throw new ValidationException('The request data was invalid.', $response->getResponseBody()),
                default => throw new HttpException('An unknown error occurred while fetching the data from the API.', $response->getResponseBody()),
            };
        }

        return $response->getResponseBodyAsArray();
    }
}
