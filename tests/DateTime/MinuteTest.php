<?php

namespace ValueObjects\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use ValueObjects\DateTime\Minute;
use ValueObjects\Exception\InvalidNativeArgumentException;

class MinuteTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeMinute  = Minute::fromNative(11);
        $constructedMinute = new Minute(11);

        $this->assertTrue($fromNativeMinute->sameValueAs($constructedMinute));
    }

    public function testNow()
    {
        $minute = Minute::now();
        $this->assertEquals(\intval(date('i')), $minute->toNative());
    }

    public function testInvalidMinute()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new Minute(60);
    }

}
