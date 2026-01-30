<?php

declare(strict_types=1);

namespace Http\Response;

use Hpolthof\PostcodeTech\Http\Response\Headers;
use PHPUnit\Framework\TestCase;

final class HeadersTest extends TestCase
{
    public static function provideStatusCodes(): iterable
    {
        yield ['HTTP/1.1 200 OK', 200];
        yield ['HTTP/1.1 404 Not Found', 404];
        yield ['HTTP/1.1 422 Unprocessable Content', 422];
        yield ['HTTP/1.1 500 Internal Server Error', 500];
    }

    /**
     * @dataProvider provideStatusCodes
     */
    public function testGetStatusCode(string $statusCode, int $expectedStatusCode): void
    {
        $headers = new Headers([
            0 => $statusCode,
        ]);

        self::assertEquals($expectedStatusCode, $headers->getStatusCode());
    }
}
