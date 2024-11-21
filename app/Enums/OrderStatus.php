<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case WAITING = 'waiting';
    case ON_PROCESS = 'on_process';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case DELIVERED = 'delivered';
    case ONGOING = 'ongoing';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::ON_PROCESS => 'On Process',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
            self::DELIVERED => 'Delivered',
            self::ONGOING => 'Ongoing',
            self::WAITING => 'Waiting',
        };
    }
}
