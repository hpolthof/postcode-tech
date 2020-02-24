<?php


namespace Hpolthof\PostcodeTech\Tests;


use Hpolthof\PostcodeTech\Exceptions\HttpException;
use Hpolthof\PostcodeTech\PostcodeRequest;
use PHPUnit\Framework\TestCase;

class PostcodeRequestTest extends TestCase
{
    const POSTCODES = [
        ['9761BL', 18, 'Molkampen', 'Eelde'],
        ['3544AM', 15, 'Kaneelhof', 'Utrecht'],
        ['5043AM', 130, 'Batenburglaan', 'Tilburg'],
    ];

    public function testCanFindAPostcode()
    {
        $postcodeSet = self::POSTCODES[rand(0, count(self::POSTCODES)-1)];

        $postcode = new PostcodeRequest();
        $postcode->setToken('demo');

        $response = $postcode->find($postcodeSet[0], $postcodeSet[1]);

        $this->assertEquals($postcodeSet[2], $response->getStreet());
        $this->assertEquals($postcodeSet[3], $response->getCity());
    }

    public function testRequiresApiToken()
    {
        $postcodeSet = self::POSTCODES[rand(0, count(self::POSTCODES)-1)];

        $postcode = new PostcodeRequest();

        $this->expectException(HttpException::class);
        $postcode->find($postcodeSet[0], $postcodeSet[1]);
    }
}