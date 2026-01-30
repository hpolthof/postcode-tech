<?php

namespace Hpolthof\PostcodeTech\Tests;

use Hpolthof\PostcodeTech\Postcode;
use PHPUnit\Framework\TestCase;

final class PostcodeTest extends TestCase
{
    public static function providePostcodeData(): iterable
    {
        yield ['1012 RJ', 147, 'Nieuwezijds Voorburgwal', 'Amsterdam'];
        yield ['2514 GL', 68, 'Noordeinde', "'s-Gravenhage"];
        yield ['2594 BD', 10, "'s-Gravenhaagse Bos", "'s-Gravenhage"];
    }

    /**
     * @dataProvider providePostcodeData
     *
     * This test actually calls the real API, so it can fail beyond our control.
     */
    public function testSearch(string $postcode, int $number, string $expectedStreet, string $expectedCity): void
    {
        $postcodeResult = Postcode::search($postcode, $number, 'demo');

        self::assertEquals($postcode, $postcodeResult->postcode());
        self::assertEquals($number, $postcodeResult->number());
        self::assertEquals($expectedStreet, $postcodeResult->street());
        self::assertEquals($expectedCity, $postcodeResult->city());
    }
}
