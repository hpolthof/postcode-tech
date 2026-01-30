<?php

declare(strict_types=1);

namespace Http\Request;

use Hpolthof\PostcodeTech\Http\Request\Headers;
use PHPUnit\Framework\TestCase;

final class HeadersTest extends TestCase
{
    public function testAddAndGetHeaders(): void
    {
        $headers = new Headers(['Authorization' => 'Bearer demo']);

        self::assertEquals("Authorization: Bearer demo\r\n", $headers->getHeaders());

        $headers->addHeader('Content-Type', 'application/json');

        self::assertEquals("Authorization: Bearer demo\r\nContent-Type: application/json\r\n", $headers->getHeaders());
    }
}
