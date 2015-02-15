<?php
namespace Moneta;

use Moneta\Event\AccountOpened;
use Moneta\Identity\UUID;

class AccountTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_be_opened()
    {
        $account = Account::open();

        $this->assertInstanceOf(Account::class, $account);
    }

    /** @test */
    public function it_should_have_uncommitted_changes_when_opened()
    {
        $account = Account::open();

        $this->assertTrue(
            $account->hasUncommittedChanges(),
            'Expecting that a new account has uncomitted changes'
        );
    }

    /** @test */
    public function it_should_be_able_to_return_uncommitted_changes()
    {
        $changes = Account::open()->getUncommittedChanges();

        $this->assertCount(1, $changes);
        $this->assertInstanceOf(AccountOpened::class, $changes[0]);
    }

    /** @test */
    public function it_should_be_able_to_commit_changes()
    {
        $account = Account::open();

        $account->commitChanges();

        $this->assertFalse(
            $account->hasUncommittedChanges(),
            'Expecting that there are no uncomitted changes after commit'
        );
    }

    /** @test */
    public function it_should_have_an_uuid()
    {
        $this->assertInstanceOf(
            UUID::class,
            Account::open()->id()
        );
    }

    /** @test */
    public function it_should_have_a_stable_uuid()
    {
        $account = Account::open();

        $this->assertSame($account->id(), $account->id());
    }
}
