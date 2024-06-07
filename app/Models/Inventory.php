<?php

namespace App\Models;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'medication_id',
        'quantity_in_stock',
        'reorder_level',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'medication_id' => 'integer',
    ];

    public function medication(): BelongsTo
    {
        return $this->belongsTo(Medication::class);
    }

    protected static function getForm(): array
    {
        return [
            Select::make('medication_id')
                ->relationship('medication', 'name'),
            TextInput::make('quantity_in_stock')
                ->required()
                ->maxLength(255),
            TextInput::make('reorder_level')
                ->required()
                ->maxLength(255),
            Actions::make([
                Action::make('star')
                    ->icon('heroicon-m-star')
                    ->label('Fill  with Factory data')
                    ->color('info')
                    ->action(function ($livewire) {
                        $data = Inventory::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ])
        ];
    }
}
