<?php
namespace Moneta;

use Moneta\Event\AccountOpened;
use Moneta\Identity\UUID;

class AccountTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_be_opened()
    {
        $account = Account::open();

        $this->assertInstanceOf(Account::class, $account);
    }

    /** @test */
    public function it_has_an_uuid_identity()
    {
        $this->assertRegExp(
            '/^([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})$/',
            Account::open()->getAggregateRootId()
        );
    }

    /** @test */
    public function it_has_a_stable_identity()
    {
        $account = Account::open();

        $this->assertSame($account->getAggregateRootId(), $account->getAggregateRootId());
    }
}
