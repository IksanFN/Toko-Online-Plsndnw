<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CASH = 'cash';
    case TRANSFER = 'transfer';

    public function getLabel(): string
    {
        return match ($this) {
            self::CASH => 'Cash',
            self::TRANSFER => 'Transfer',
        };
    }
}
