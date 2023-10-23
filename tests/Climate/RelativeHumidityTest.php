<?php

namespace ValueObjects\Tests\Climate;

use PHPUnit\Framework\TestCase;
use ValueObjects\Climate\RelativeHumidity;
use ValueObjects\Exception\InvalidNativeArgumentException;

class RelativeHumidityTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeRelHum  = RelativeHumidity::fromNative(70);
        $constructedRelHum = new RelativeHumidity(70);

        $this->assertTrue($fromNativeRelHum->sameValueAs($constructedRelHum));
    }
    
    /**
     * @return void
     */
    public function testInvalidRelativeHumidity(): void
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new RelativeHumidity(128);
    }
}
