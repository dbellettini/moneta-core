<?php
namespace Moneta;

/**
 * Value object representing a money amount
 */
final class Money
{
    private $cents;

    private $currency;

    public static function fromString($string)
    {
        preg_match('/^([0-9]+).([0-9]{2})\/([A-Z]{3})/', $string, $matches);

        return new self(
            100 * (int) $matches[1] + (int) $matches[2],
            $matches[3]
        );
    }

    private function __construct($cents, $currency)
    {
        $this->cents = $cents;
        $this->currency = $currency;
    }

    public function cents()
    {
        return $this->cents;
    }

    public function currency()
    {
        return $this->currency;
    }
}
