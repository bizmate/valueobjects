<?php
declare(strict_types=1);

namespace ValueObjects\Tests\Climate;

use PHPUnit\Framework\Attributes\DataProvider;
use ValueObjects\Climate\Celsius;
use PHPUnit\Framework\TestCase;

class CelsiusTest extends TestCase
{
    public function setUp(): void
    {
        # When tests run in a different locale, this might affect the decimal-point character and thus the validation
        # of floats. This makes sure the tests run in a locale that the tests are known to be working in.
        setlocale(LC_ALL, "en_US.UTF-8");
    }

    public static function temperatureProvider()
    {
        return array(array(new Celsius(10)));
    }
    
    #[DataProvider('temperatureProvider')]
    public function testToCelsius(Celsius $temperature)
    {
        $this->assertEquals(10, $temperature->toCelsius()->toNative());
    }
    
    #[DataProvider('temperatureProvider')]
    public function testToKelvin(Celsius $temperature)
    {
        $this->assertEquals(10 + 273.15, $temperature->toKelvin()->toNative());
    }
    
    #[DataProvider('temperatureProvider')]
    public function testToFahrenheit(Celsius $temperature)
    {
        $this->assertEquals(10 * 1.8 + 32, $temperature->toFahrenheit()->toNative());
    }
    
    #[DataProvider('temperatureProvider')]
    public function testDifferentLocaleWithDifferentDecimalCharacter(Celsius $temperature)
    {
        setlocale(LC_ALL, "de_DE.UTF-8");

        $this->testToCelsius($temperature);
        $this->testToKelvin($temperature);
        $this->testToFahrenheit($temperature);
    }
}
