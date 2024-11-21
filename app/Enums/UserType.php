<?php

namespace App\Enums;

enum UserType: string
{
    case ADMIN = 'admin';
    case CUSTOMER = 'customer';

    public function getLabel()
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::CUSTOMER => 'Customer',
        };
    }
}
