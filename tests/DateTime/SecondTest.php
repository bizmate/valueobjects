<?php

namespace ValueObjects\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use ValueObjects\DateTime\Second;
use ValueObjects\Exception\InvalidNativeArgumentException;

class SecondTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeSecond  = Second::fromNative(13);
        $constructedSecond = new Second(13);

        $this->assertTrue($fromNativeSecond->sameValueAs($constructedSecond));
    }

    public function testNow()
    {
        $second = Second::now();
        $this->assertEquals(\intval(date('s')), $second->toNative());
    }

    public function testInvalidSecond()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new Second(60);
    }

}
