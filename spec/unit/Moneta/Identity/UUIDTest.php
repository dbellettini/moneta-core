<?php
namespace Moneta\Identity;

class UUIDTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_be_converted_to_string()
    {
        $this->assertRegexp(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/',
            (string)(UUID::random())
        );
    }

    /** @test */
    public function it_should_be_boxed_from_string()
    {
        $uuidAsString = '067ae7a7-3f9d-4d54-aa20-a19f13ce5530';

        $boxed = UUID::box($uuidAsString);

        $this->assertInstanceOf(UUID::class, $boxed);
        $this->assertEquals($uuidAsString, (string)$boxed);
    }
}
