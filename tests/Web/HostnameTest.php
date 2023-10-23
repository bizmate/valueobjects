<?php

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Web\Hostname;

class HostnameTest extends TestCase
{
    public function testInvalidHostname()
    {
        $this->expectException(InvalidNativeArgumentException::class);
    
        new Hostname('inv@lìd');
    }
}
