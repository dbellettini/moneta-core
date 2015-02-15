<?php
namespace Moneta\Event;

use Moneta\Identity\UUID;

class AccountOpenedTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_have_an_uuid()
    {
        $this->assertInstanceOf(
            UUID::class,
            (new AccountOpened)->id()
        );
    }

    /** @test */
    public function it_should_have_a_stable_uuid()
    {
        $accountOpened = new AccountOpened();

        $this->assertSame($accountOpened->id(), $accountOpened->id());
    }

    /** @test */
    public function it_should_have_a_different_uuid()
    {
        $this->assertNotEquals(
            (new AccountOpened)->id(),
            (new AccountOpened)->id()
        );
    }

    /** @test */
    public function it_should_accept_uuid_from_outside()
    {
        $id = UUID::random();
        $accountOpened = new AccountOpened($id);

        $this->assertEquals($id, $accountOpened->id());
    }
}
