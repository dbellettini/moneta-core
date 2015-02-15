<?php
namespace Moneta\Event;

use Moneta\Identity\UUID;

final class AccountOpened
{
    private $id;

    public function __construct(UUID $id = null)
    {
        if (null === $id) {
            $id = UUID::random();
        }

        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
