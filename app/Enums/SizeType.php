<?php

namespace App\Enums;

enum SizeType: string
{
    case XS = 'XS';
    case S = 'S';
    case M = 'M';
    case L = 'L';
    case XL = 'XL';
    case XXL = 'XXL';

    public static function getLabels(): array
    {
        return array_column(SizeType::cases(), 'value');
    }
}
