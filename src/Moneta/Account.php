<?php
namespace Moneta;

use Moneta\Event\AccountOpened;
use Moneta\Identity\UUID;

final class Account extends AggregateRoot
{
    private $id;
    private $changes = [];

    public static function open()
    {
        $account = new self();

        $account->apply(new AccountOpened, true);

        return $account;
    }

    public static function fromHistory(array $history)
    {
        $account = new self();

        foreach ($history as $event) {
            $account->apply($event, false);
        }

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

    public function id()
    {
        return $this->id;
    }

    private function apply(AccountOpened $event, $new)
    {
        if ($new) {
            $this->changes[] = $event;
        }

        $this->id = $event->id();
    }
}
