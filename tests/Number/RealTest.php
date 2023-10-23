<?php

namespace ValueObjects\Tests\Number;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Real;
use ValueObjects\Number\Integer;
use ValueObjects\Number\Natural;
use ValueObjects\ValueObjectInterface;

class RealTest extends TestCase
{
    public function setUp(): void
    {
        # When tests run in a different locale, this might affect the decimal-point character and thus the validation
        # of floats. This makes sure the tests run in a locale that the tests are known to be working in.
        setlocale(LC_ALL, "en_US.UTF-8");
    }

    public function testFromNative()
    {
        $fromNativeReal  = Real::fromNative(.056);
        $constructedReal = new Real(.056);

        $this->assertTrue($fromNativeReal->sameValueAs($constructedReal));
    }

    public function testToNative()
    {
        $real = new Real(3.4);
        $this->assertEquals(3.4, $real->toNative());
    }

    public function testSameValueAs()
    {
        $real1 = new Real(5.64);
        $real2 = new Real(5.64);
        $real3 = new Real(6.01);

        $this->assertTrue($real1->sameValueAs($real2));
        $this->assertTrue($real2->sameValueAs($real1));
        $this->assertFalse($real1->sameValueAs($real3));

        $mock = $this->getMockBuilder(ValueObjectInterface::class)
            ->getMock();
        $this->assertFalse($real1->sameValueAs($mock));
    }

    public function testInvalidNativeArgument()
    {
        $this->expectException(\TypeError::class);
    
        new Real('invalid');
    }

    public function testToInteger()
    {
        $real          = new Real(3.14);
        $nativeInteger = new Integer(3);
        $integer       = $real->toInteger();

        $this->assertTrue($integer->sameValueAs($nativeInteger));
    }

    public function testToNatural()
    {
        $real          = new Real(3.14);
        $nativeNatural = new Natural(3);
        $natural       = $real->toNatural();

        $this->assertTrue($natural->sameValueAs($nativeNatural));
    }

    public function testToString()
    {
        $expectedString = '0.7';
        $real = new Real(.7);
        $realToString = $real->__toString();
        $this->assertEquals($expectedString, $realToString, "String expected : " . $expectedString . " and actual: " . $realToString);
    }

    public function testDifferentLocaleWithDifferentDecimalCharacter()
    {
        setlocale(LC_ALL, "de_DE.UTF-8");

        $this->testFromNative();
        $this->testToNative();
        $this->testSameValueAs();
        $this->testToInteger();
        $this->testToNatural();
        $this->testToString('0,7');
    }
}
