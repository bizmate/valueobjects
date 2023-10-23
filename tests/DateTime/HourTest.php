<?php

namespace ValueObjects\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use ValueObjects\DateTime\Hour;
use ValueObjects\Exception\InvalidNativeArgumentException;

class HourTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeHour  = Hour::fromNative(21);
        $constructedHour = new Hour(21);

        $this->assertTrue($fromNativeHour->sameValueAs($constructedHour));
    }

    public function testNow()
    {
        $hour = Hour::now();
        $this->assertEquals(date('G'), $hour->toNative());
    }

    public function testInvalidHour()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new Hour(24);
    }

}
