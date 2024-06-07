<?php

namespace App\Models;

use App\Enums\ShipmentStatus;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
        'shipment_date',
        'received_date',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'supplier_id' => 'integer',
        'shipment_date' => 'date',
        'received_date' => 'date',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function shipmentItems(): HasMany
    {
        return $this->hasMany(ShipmentItem::class);
    }

    public static function getForm()
    {
        return [
            Select::make('supplier_id')
                ->relationship('supplier', 'name'),
            DateTimePicker::make('shipment_date')
                ->required(),
            DateTimePicker::make('received_date')
                ->required(),
            Select::make('status')
                ->required()
                ->enum(ShipmentStatus::class)
                ->options(ShipmentStatus::class),
            Actions::make([
                Action::make('star')
                    ->icon('heroicon-m-star')
                    ->label('Fill  with Factory data')
                    ->color('info')
                    ->action(function ($livewire) {
                        $data = Shipment::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ])
        ];
    }
}
