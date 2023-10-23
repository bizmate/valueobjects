<?php

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\TestCase;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Web\FragmentIdentifier;
use ValueObjects\Web\NullFragmentIdentifier;

class FragmentIdentifierTest extends TestCase
{
    public function testValidFragmentIdentifier()
    {
        $fragment = new FragmentIdentifier('#id');

        $this->assertInstanceOf('ValueObjects\Web\FragmentIdentifier', $fragment);
    }

    public function testNullFragmentIdentifier()
    {
        $fragment = new NullFragmentIdentifier();

        $this->assertInstanceOf('ValueObjects\Web\FragmentIdentifier', $fragment);
    }

    public function testInvalidFragmentIdentifier()
    {
        $this->expectException(InvalidNativeArgumentException::class);
    
        new FragmentIdentifier('invalìd');
    }
}
