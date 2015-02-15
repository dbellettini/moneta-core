<?php
namespace Moneta;

final class Account
{
    public static function open()
    {
        return new self();
    }
}
