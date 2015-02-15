<?php
namespace Moneta\Identity;

use Rhumsaa\Uuid\Uuid as RhumsaaUUID;

final class UUID
{
    public static function random()
    {
        return new self(
            RhumsaaUUID::uuid4()
        );
    }

    public static function box($uuidToBox)
    {
        return new self(RhumsaaUUID::fromString($uuidToBox));
    }

    private function __construct(RhumsaaUUID $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public function __toString()
    {
        return (string)$this->wrapped;
    }
}
