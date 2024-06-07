<?php

namespace App\Filament\Resources\ShipmentItemResource\Pages;

use App\Filament\Resources\ShipmentItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShipmentItem extends EditRecord
{
    protected static string $resource = ShipmentItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
