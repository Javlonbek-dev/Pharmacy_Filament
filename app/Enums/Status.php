<?php

namespace App\Enums;

enum Status: string
{
    case Received = 'Received';
    case Completed = 'Completed';
    case Cancelled = 'Cancelled';

    public function getColor():string
    {
        return match ($this)
        {
            self::Received => 'success',
            self::Completed => 'info',
            self::Cancelled => 'danger',
        };
    }
}
