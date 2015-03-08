<?php
namespace Moneta;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    public static function stringBoxProvider()
    {
        return [
            ['1.00 EUR', 100, 'EUR'],
            ['1.00 USD', 100, 'USD'],
            ['2.00 USD', 200, 'USD'],
        ];
    }

    /**
     * @test
     * @dataProvider stringBoxProvider
     */
    public function it_can_be_boxed_from_string($string, $cents, $currency)
    {
        $money = Money::fromString($string);

        $this->assertSame($cents, $money->cents());
        $this->assertEquals($currency, $money->currency());
    }

    /**
     * @test
     * @dataProvider stringBoxProvider
     */
    public function it_can_be_boxed_from_cents_and_currency($_, $cents, $currency)
    {
        $money = Money::fromCentsAndCurrency($cents, $currency);

        $this->assertSame($cents, $money->cents());
        $this->assertEquals($currency, $money->currency());
    }
}
