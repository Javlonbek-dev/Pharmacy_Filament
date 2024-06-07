<?php

namespace App\Models;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prescription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'pharmacist_id',
        'prescription_date',
        'doctor_name',
        'total_amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'pharmacist_id' => 'integer',
        'prescription_date' => 'date',
        'total_amount' => 'float',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function pharmacist(): BelongsTo
    {
        return $this->belongsTo(Pharmacist::class);
    }

    public function prescriptionItems(): HasMany
    {
        return $this->hasMany(Prescription_Item::class);
    }

    public static function getForm()
    {
        return [
            Select::make('customer_id')
                ->relationship('customer', 'full_name'),
            Select::make('pharmacist_id')
                ->label('Pharmacist License Number')
                ->relationship('pharmacist', 'license_number'),
            DateTimePicker::make('prescription_date')
                ->required(),
            TextInput::make('doctor_name')
                ->required()
                ->maxLength(255),
            TextInput::make('total_amount')
                ->required()
                ->numeric(),
            Actions::make([
                Action::make('star')
                    ->icon('heroicon-m-star')
                    ->label('Fill  with Factory data')
                    ->color('info')
                    ->action(function ($livewire) {
                        $data = Prescription::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ])
        ];
    }
}
