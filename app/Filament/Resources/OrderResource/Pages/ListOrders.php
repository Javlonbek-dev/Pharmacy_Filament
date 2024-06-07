<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\Status;
use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    public function getTabs(): array
    {
        return [
            'all'=>Tab::make('All Orders'),
            'received'=>Tab::make('Received')
            ->modifyQueryUsing(function ($query){
                return $query->where('status', Status::Received);
            }),
            'completed'=>Tab::make('Completed')
            ->modifyQueryUsing(function ($query){
                return $query->where('status', Status::Completed);
            }),
            'cancelled'=>Tab::make('Cancelled')
            ->modifyQueryUsing(function ($query){
                return $query->where('status', Status::Cancelled);
            })
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
