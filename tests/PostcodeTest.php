<?php

namespace Hpolthof\PostcodeTech\Tests;

use Hpolthof\PostcodeTech\Postcode;
use PHPUnit\Framework\TestCase;

class PostcodeTest extends TestCase
{
    const POSTCODES = [
        ['9761BL', 18, 'Molkampen', 'Eelde'],
        ['3544AM', 15, 'Kaneelhof', 'Utrecht'],
        ['5043AM', 130, 'Batenburglaan', 'Tilburg'],
    ];

    public function testCanFindAPostcode()
    {
        $postcodeSet = self::POSTCODES[rand(0, count(self::POSTCODES)-1)];

        $postcode = Postcode::search($postcodeSet[0], $postcodeSet[1], 'demo');

        $this->assertEquals($postcodeSet[2], $postcode->street());
        $this->assertEquals($postcodeSet[3], $postcode->city());
    }

}