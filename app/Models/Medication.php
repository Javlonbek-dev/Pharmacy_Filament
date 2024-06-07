<?php

namespace App\Models;

use App\Enums\Dosage_Form;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Medication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'manufacturer',
        'dosage_form',
        'strength',
        'price',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'float',
    ];

    public function prescriptionItems(): HasMany
    {
        return $this->hasMany(PrescriptionItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shipmentItems(): HasMany
    {
        return $this->hasMany(ShipmentItem::class);
    }

    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class);
    }

    public static function getForm(): array
    {
        return [
            Tabs::make()
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Medication Details')
                        ->columnSpanFull()
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            RichEditor::make('description')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('manufacturer')
                                ->required()
                                ->maxLength(255),
                        ]),
                    Tabs\Tab::make('Prescriptions')
                        ->columnSpanFull()
                        ->schema([

                            Select::make('dosage_form')
                                ->required()
                                ->options(Dosage_Form::class)
                                ->enum(Dosage_Form::class),
                            TextInput::make('strength')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->prefix('$'),
                            Actions::make([
                                Action::make('star')
                                    ->icon('heroicon-m-star')
                                    ->label('Fill  with Factory data')
                                    ->color('info')
                                    ->action(function ($livewire) {
                                        $data = Medication::factory()->make()->toArray();
                                        $livewire->form->fill($data);
                                    }),
                            ])
                        ])
                ]),
        ];
    }
}
