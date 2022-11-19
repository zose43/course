<?php

namespace Tests\Unit\Support\ValueObjects;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Support\ValueObjects\Price;

/**
 * @coversDefaultClass Price
 */
class PriceTest extends TestCase
{
    private Price $price;

    protected function setUp(): void
    {
        parent::setUp();

        $this->price = Price::make(100000);
    }

    /**
     * @test
     */
    public function is_created_price_valid_instance(): void
    {
        $this->assertInstanceOf(Price::class, $this->price);
    }

    /**
     * @test
     */
    public function is_valid_serialization_to_string(): void
    {
        $this->assertEquals('1 000,00 ₽', $this->price->__toString());
    }

    /**
     * @test
     */
    public function is_valid_currency_symbol(): void
    {
        $this->assertEquals('₽', $this->price->getCurrencySymbol());
    }

    /**
     * @test
     */
    public function is_valid_currency(): void
    {
        $this->assertEquals('RUB', $this->price->getCurrency());
    }

    /**
     * @test
     * @covers Price::getRaw
     */
    public function is_input_value_equals_raw_method(): void
    {
        $this->assertEquals(100000, $this->price->getRaw());
    }

    /**
     * @test
     */
    public function is_exception_exist_at_negative_int(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Price must be more than 0!');

        Price::make(-100000);
    }

    /**
     * @test
     */
    public function is_exception_exist_at_unsupported_currency(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Currency is not supported');

        Price::make(100000, 'EU');
    }
}