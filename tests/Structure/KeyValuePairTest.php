<?php
declare(strict_types=1);

namespace ValueObjects\Tests\Structure;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Structure\KeyValuePair;
use PHPUnit\Framework\TestCase;
use ValueObjects\ValueObjectInterface;

class KeyValuePairTest extends TestCase
{
    /** @var KeyValuePair */
    protected $keyValuePair;

    public function setUp(): void
    {
        $this->keyValuePair = new KeyValuePair(
            new StringLiteral('key'),
            new StringLiteral('value')
        );
    }

    public function testFromNative()
    {
        $fromNativePair = KeyValuePair::fromNative('key', 'value');
        $this->assertTrue($this->keyValuePair->sameValueAs($fromNativePair));
    }

    public function testInvalidFromNative()
    {
        $this->expectException(\BadMethodCallException::class);
        KeyValuePair::fromNative('key', 'value', 'invalid');
    }

    public function testSameValueAs()
    {
        $keyValuePair2 = new KeyValuePair(new StringLiteral('key'), new StringLiteral('value'));
        $keyValuePair3 = new KeyValuePair(new StringLiteral('foo'), new StringLiteral('bar'));

        $this->assertTrue($this->keyValuePair->sameValueAs($keyValuePair2));
        $this->assertTrue($keyValuePair2->sameValueAs($this->keyValuePair));
        $this->assertFalse($this->keyValuePair->sameValueAs($keyValuePair3));

        $mock = $this->getMockBuilder(ValueObjectInterface::class)
            ->getMock();
        $this->assertFalse($this->keyValuePair->sameValueAs($mock));
    }

    public function testGetKey()
    {
        $this->assertEquals('key', $this->keyValuePair->getKey());
    }

    public function testGetValue()
    {
        $this->assertEquals('value', $this->keyValuePair->getValue());
    }

    public function testToString()
    {
        $this->assertEquals('key => value', $this->keyValuePair->__toString());
    }
}
