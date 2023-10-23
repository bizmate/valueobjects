<?php

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Web\IPv4Address;

class IPv4AddressTest extends TestCase
{
    public function testValidIPv4Address()
    {
        $ip = new IPv4Address('127.0.0.1');

        $this->assertInstanceOf('ValueObjects\Web\IPv4Address', $ip);
    }

    public function testInvalidIPv4Address()
    {
        $this->expectException(InvalidNativeArgumentException::class);
    
        new IPv4Address('::1');
    }
}
