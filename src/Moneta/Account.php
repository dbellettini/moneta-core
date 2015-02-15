<?php
namespace Moneta;

use Moneta\Event\AccountOpened;

final class Account
{
    private $changes = [];

    public static function open()
    {
        $account = new self();

        $account->apply(new AccountOpened);

        return $account;
    }

    private function __construct()
    {
    }

    public function hasUncommittedChanges()
    {
        return count($this->changes) > 0;
    }

    public function getUncommittedChanges()
    {
        return $this->changes;
    }

    public function commitChanges()
    {
        $this->changes = [];
    }

    private function apply(AccountOpened $event)
    {
        $this->changes[] = $event;
    }
}
