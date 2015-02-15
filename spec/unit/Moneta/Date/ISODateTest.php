<?php
namespace Moneta\Date;

use DateTime;

class ISODateTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_be_boxed_from_datetime()
    {
        $date = new DateTime('2015-05-21T00:00Z');

        $boxed = ISODate::box($date);

        $this->assertInstanceOf(
            ISODate::class,
            $boxed
        );

        $this->assertEquals(
            '2015-05-21T00:00:00+0000',
            (string)$boxed
        );
    }
}
