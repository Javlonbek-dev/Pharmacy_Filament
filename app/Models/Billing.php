<?php

namespace App\Models;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Billing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'order_id',
        'total_amount',
        'billing_date',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'order_id' => 'integer',
        'billing_date' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function getForm(): array
    {
        return [
            Select::make('customer_id')
                ->relationship('customer.user', 'name'),
            Select::make('order_id')
                ->relationship('order', 'id'),
            TextInput::make('total_amount')
                ->required()
                ->label('Total Amount')
                ->numeric(),
            DateTimePicker::make('billing_date')
                ->required(),
            Toggle::make('status')
                ->label('Status'),
            Actions::make([
                Action::make('star')
                    ->icon('heroicon-m-star')
                    ->label('Fill  with Factory data')
                    ->color('info')
                    ->action(function ($livewire) {
                        $data = Billing::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ])
        ];
    }
}
