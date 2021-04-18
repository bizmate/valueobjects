<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\CountryCode;
use ValueObjects\Geography\CountryCodeName;
use ValueObjects\StringLiteral\StringLiteral;
use PHPUnit\Framework\TestCase;

class CountryCodeNameTest extends TestCase
{
    public function testGetName(): void
    {
        $code = CountryCode::IT();
        $name = CountryCodeName::getName($code);
        $expectedString = new StringLiteral('Italy');

        $this->assertTrue($name->sameValueAs($expectedString));
    }
}
