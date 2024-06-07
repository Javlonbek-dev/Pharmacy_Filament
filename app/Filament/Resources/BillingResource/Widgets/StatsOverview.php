<?php

namespace App\Filament\Resources\BillingResource\Widgets;

use App\Models\Billing;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Billings count', Billing::count())
            ->chart([1,2,3,4,5])
                ->description('Billing Count')
                ->descriptionIcon('heroicon-s-user-group')
            ->color('success'),
            Stat::make('Total amount', Billing::sum('total_amount')),
        ];
    }
}
