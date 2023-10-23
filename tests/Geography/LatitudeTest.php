<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Latitude;
use PHPUnit\Framework\TestCase;

class LatitudeTest extends TestCase
{
    public function testValidLatitude()
    {
        $this->assertInstanceOf(
            Latitude::class,
            new Latitude(40.829137)
        );
    }

    public function testNormalization()
    {
        $latitude = new Latitude(91);
        $this->assertEquals(90, $latitude->toNative());
    }

    public function testInvalidLatitude()
    {
        $this->expectException(\TypeError::class);
    
        new Latitude('invalid');
    }
}
