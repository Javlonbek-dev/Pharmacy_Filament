<?php

namespace App\Enums;

enum PayStatus: string
{

    case Paid = 'Paid';
    case UnPaid = 'UnPaid';

    public function getColor(): string
    {
        return match ($this) {
            self::Paid => 'success',
            self::UnPaid => 'danger',
        };
    }
}
