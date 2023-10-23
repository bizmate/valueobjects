<?php

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Web\Path;

class PathTest extends TestCase
{
    public function testValidPath()
    {
        $pathString = '/path/to/resource.ext';
        $path = new Path($pathString);
        $this->assertEquals($pathString, $path->toNative());
    }

    public function testInvalidPath()
    {
        $this->expectException(InvalidNativeArgumentException::class);
    
        new Path('//valid?');
    }
}
