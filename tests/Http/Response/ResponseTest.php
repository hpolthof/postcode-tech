<?php

declare(strict_types=1);

namespace Http\Response;

use Hpolthof\PostcodeTech\Exceptions\HttpException;
use Hpolthof\PostcodeTech\Http\Response\Response;
use PHPUnit\Framework\TestCase;

final class ResponseTest extends TestCase
{
    public static function provideStatusCodes(): iterable
    {
        yield [200, true];
        yield [404, false];
        yield [422, false];
        yield [500, false];
    }

    /**
     * @dataProvider provideStatusCodes
     */
    public function testIsSuccess(int $statusCode, bool $expectedIsSuccess): void
    {
        $response = new Response('', [0 => sprintf('HTTP/1.1 %s', $statusCode)]);

        self::assertEquals($expectedIsSuccess, $response->isSuccess());
    }

    public function testGetResponseBodyAsArrayThrowsExceptionForInvalidJsonArray(): void
    {
        self::expectException(HttpException::class);
        self::expectExceptionMessage('The response body is not a valid JSON array.');

        $response = new Response('', []);
        $response->getResponseBodyAsArray();
    }

    public static function provideInvalidJsonResponseBodies(): iterable
    {
        yield ['{}'];
        yield ['{"street": "", "city": ""}'];
        yield ['{"city": ""}'];
        yield ['{"street": "", "city": ""}'];
        yield ['{"street": "non-empty", "city": ""}'];
        yield ['{"street": "", "city": "non-empty"}'];
    }

    /**
     * @dataProvider provideInvalidJsonResponseBodies
     */
    public function testGetResponseBodyAsArrayThrowsExceptionForInvalidJsonArrayStructure(string $responseBody): void
    {
        self::expectException(HttpException::class);
        self::expectExceptionMessage('The response body did not contain the expected data.');

        $response = new Response($responseBody, []);
        $response->getResponseBodyAsArray();
    }

    public function testGetResponseBodyAsArrayReturnsArray(): void
    {
        $response = new Response('{"street": "straat", "city": "stad"}', []);
        $responseBodyArray = $response->getResponseBodyAsArray();

        self::assertSame('straat', $responseBodyArray['street']);
        self::assertSame('stad', $responseBodyArray['city']);
    }
}
