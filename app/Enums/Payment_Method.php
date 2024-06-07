<?php

namespace App\Enums;

enum Payment_Method: string
{
    case Credit_Card = 'Credit_Card';
    case Cash = 'Cash';

    public function getColor(): string
    {
        return match ($this) {
            self::Credit_Card => 'success',
            self::Cash => 'info',
        };
    }

}
