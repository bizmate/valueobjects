<?php

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Web\IPv6Address;

class IPv6AddressTest extends TestCase
{
    public function testValidIPv6Address()
    {
        $ip = new IPv6Address('::1');

        $this->assertInstanceOf('ValueObjects\Web\IPv6Address', $ip);
    }

    public function testInvalidIPv6Address()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new IPv6Address('127.0.0.1');
    }
}
