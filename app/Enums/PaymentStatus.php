<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PAID = 'paid';
    case UNPAID = 'unpaid';
    case REFUNDED = 'refunded';
    case CANCELLED = 'cancelled';
    case PENDING = 'pending';
    case FAILED = 'failed';

    public function getLabel(): string
    {
        return match ($this) {
            self::PAID => 'Paid',
            self::UNPAID => 'Unpaid',
            self::REFUNDED => 'Refunded',
            self::CANCELLED => 'Cancelled',
            self::PENDING => 'Pending',
            self::FAILED => 'Failed',
        };
    }
}
