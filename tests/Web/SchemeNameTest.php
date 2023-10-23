<?php

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Web\SchemeName;

class SchemeNameTest extends TestCase
{
    public function testValidSchemeName()
    {
        $scheme = new SchemeName('git+ssh');
        $this->assertInstanceOf('ValueObjects\Web\SchemeName', $scheme);
    }

    public function testInvalidSchemeName()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new SchemeName('ht*tp');
    }
}
