<?php


use Hpolthof\PostcodeTech\Client;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client('demo');
    }

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
        $result = $this->client->get($postcode, $number);

        self::assertEquals($expectedStreet, $result['street']);
        self::assertEquals($expectedCity, $result['city']);
    }
}
