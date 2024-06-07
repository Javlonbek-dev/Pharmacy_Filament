<?php

namespace App\Models;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShipmentItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shipment_id',
        'medication_id',
        'quantity',
        'cost_price',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'shipment_id' => 'integer',
        'medication_id' => 'integer',
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function medication(): BelongsTo
    {
        return $this->belongsTo(Medication::class);
    }

    public static function getForm()
    {
        return [
            Select::make('shipment_id')
                ->relationship('shipment', 'id'),
            Select::make('medication_id')
                ->relationship('medication', 'name'),
            TextInput::make('quantity')
                ->required()
                ->numeric(),
            TextInput::make('cost_price')
                ->required()
                ->numeric(),
            Actions::make([
                Action::make('star')
                    ->icon('heroicon-m-star')
                    ->label('Fill  with Factory data')
                    ->color('info')
                    ->action(function ($livewire) {
                        $data = ShipmentItem::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ])
        ];
    }
}
