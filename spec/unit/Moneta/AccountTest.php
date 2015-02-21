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
    public function it_has_uncommitted_changes_when_opened()
    {
        $account = Account::open();

        $this->assertTrue(
            $account->hasUncommittedChanges(),
            'Expecting that a new account has uncomitted changes'
        );
    }

    /** @test */
    public function it_is_able_to_return_uncommitted_changes()
    {
        $changes = Account::open()->getUncommittedChanges();

        $this->assertCount(1, $changes);
        $this->assertInstanceOf(AccountOpened::class, $changes[0]);
    }

    /** @test */
    public function it_is_able_to_commit_changes()
    {
        $account = Account::open();

        $account->commitChanges();

        $this->assertFalse(
            $account->hasUncommittedChanges(),
            'Expecting that there are no uncomitted changes after commit'
        );
    }

    /** @test */
    public function it_has_an_uuid_identity()
    {
        $this->assertInstanceOf(
            UUID::class,
            Account::open()->id()
        );
    }

    /** @test */
    public function it_has_a_stable_identity()
    {
        $account = Account::open();

        $this->assertSame($account->id(), $account->id());
    }

    /** @test */
    public function it_can_be_loaded_from_history()
    {
        $account1 = Account::open();
        $account2 = Account::fromHistory($account1->getUncommittedChanges());

        $this->assertEquals($account1->id(), $account2->id());
    }

    /** @test */
    public function it_has_no_uncommitted_changes_when_loaded_from_history()
    {
        $account = Account::fromHistory(Account::open()->getUncommittedChanges());

        $this->assertFalse($account->hasUncommittedChanges());
    }
}
