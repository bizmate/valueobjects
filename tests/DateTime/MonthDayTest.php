<?php

namespace ValueObjects\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use ValueObjects\DateTime\MonthDay;
use ValueObjects\Exception\InvalidNativeArgumentException;

class MonthDayTest extends TestCase
{
    public function fromNative()
    {
        $fromNativeMonthDay  = MonthDay::fromNative(15);
        $constructedMonthDay = new MonthDay(15);

        $this->assertTrue($fromNativeMonthDay->sameValueAs($constructedMonthDay));
    }

    public function testNow()
    {
        $monthDay = MonthDay::now();
        $this->assertEquals(date('j'), $monthDay->toNative());
    }

    public function testInvalidMonthDay()
    {
        $this->expectException(InvalidNativeArgumentException::class);
    
        new MonthDay(32);
    }

}
