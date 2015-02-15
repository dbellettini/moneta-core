<?php
namespace Moneta\Date;

use DateTime;

class ISODate
{
    private $wrapped;

    public static function box($dateToBeBoxed)
    {
        return new self(
            $dateToBeBoxed
        );
    }

    private function __construct(DateTime $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public function __toString()
    {
        return $this->wrapped->format(DateTime::ISO8601);
    }
}
