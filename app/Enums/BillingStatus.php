<?php

namespace App\Enums;

enum BillingStatus: string
{

    case Paid = 'Paid';
    case UnPaid = 'UnPaid';

    public function getColor()
    {
        return match ($this) {
            self::Paid => 'success',
            self::UnPaid => 'danger',
        };
    }
}

