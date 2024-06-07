<?php

namespace App\Filament\Resources\ShipmentItemResource\Pages;

use App\Filament\Resources\ShipmentItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShipmentItems extends ListRecords
{
    protected static string $resource = ShipmentItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
