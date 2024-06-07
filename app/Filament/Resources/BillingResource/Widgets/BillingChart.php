<?php

namespace App\Filament\Resources\BillingResource\Widgets;

use App\Filament\Resources\BillingResource\Pages\ListBillings;
use App\Models\Billing;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BillingChart extends ChartWidget
{
    protected static ?string $heading = 'Billing';

    public function getTablePage(): string
    {
        return ListBillings::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Billings count', Billing::count()),
            Stat::make('Total amount', Billing::sum('total_amount')),
        ];
    }
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
