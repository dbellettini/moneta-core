<?php
namespace Moneta;

use Broadway\Domain\DomainEventStream;
use Moneta\Event\AccountOpened;

final class Account extends AggregateRoot
{
    private $id;
    private $changes = [];

    public static function open()
    {
        $account = new self();

        $account->apply(new AccountOpened);

        return $account;
    }

    public static function fromHistory(array $history)
    {
        $account = new self();

        $account->initializeState(new DomainEventStream($history));

        return $account;
    }

    private function __construct()
    {
    }

    public function getAggregateRootId()
    {
        return (string) $this->id;
    }

    protected function applyAccountOpened(AccountOpened $event)
    {
        $this->id = $event->id();
    }
}
