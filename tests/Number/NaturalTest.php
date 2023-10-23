<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;
use PHPUnit\Framework\TestCase;

class NaturalTest extends TestCase
{
    public function testInvalidNativeArgument()
    {
        $this->expectException(InvalidNativeArgumentException::class);
    
        new Natural(-2);
    }
}
