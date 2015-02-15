<?php
namespace Moneta;

use Moneta\Event\AccountOpened;
use Moneta\Identity\UUID;

final class Account
{
    private $id;
    private $changes = [];

    public static function open()
    {
        $account = new self();

        $account->apply(new AccountOpened);

        return $account;
    }

    private function __construct()
    {
        $this->id = UUID::random();
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

    public function id()
    {
        return $this->id;
    }

    private function apply(AccountOpened $event)
    {
        $this->changes[] = $event;
    }
}
