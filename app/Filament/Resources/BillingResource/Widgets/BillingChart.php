<?php

namespace App\Filament\Resources\BillingResource\Widgets;

use Filament\Widgets\ChartWidget;

class BillingChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
