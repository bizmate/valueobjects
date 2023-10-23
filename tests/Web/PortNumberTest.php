<?php

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Web\PortNumber;

class PortNumberTest extends TestCase
{
    public function testValidPortNumber()
    {
        $port = new PortNumber(80);

        $this->assertInstanceOf('ValueObjects\Web\PortNumber', $port);
    }

    public function testInvalidPortNumber()
    {
        $this->expectException(InvalidNativeArgumentException::class);
    
        new PortNumber(65536);
    }
}
