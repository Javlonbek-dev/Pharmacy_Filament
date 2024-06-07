<?php

namespace App\Enums;

enum ShipmentStatus: string
{
    case Received = 'Received';
    case Pending = 'Pending';

    public function getColor(): string
    {
        return match ($this) {
            self::Received => 'success',
            self::Pending => 'warning',
        };
    }
}
