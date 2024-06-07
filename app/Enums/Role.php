<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'Admin';
    case Customer = 'Customer';
    case Pharmacist = 'Pharmacist';
}
