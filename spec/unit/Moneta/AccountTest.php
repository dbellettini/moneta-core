<?php
namespace Moneta;

class AccountTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_be_opened()
    {
        $account = Account::open();

        $this->assertInstanceOf(Account::class, $account);
    }
}
