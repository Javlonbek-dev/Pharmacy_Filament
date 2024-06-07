<?php

namespace App\Models;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'full_name',
        'address',
        'phone_number',
        'date_of_birth',
    ];

    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'date_of_birth' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class);
    }

    public static function getForm(): array
    {
        return [
            Select::make('user_id')
                ->relationship('user', 'name'),
            TextInput::make('address')
                ->required()
                ->maxLength(255),
            TextInput::make('phone_number')
                ->tel()
                ->required(),
            DateTimePicker::make('date_of_birth')
                ->required(),
            Actions::make([
                Action::make('star')
                    ->icon('heroicon-m-star')
                    ->label('Fill with Factory Data ')
                    ->visible(function (string $operation){
                        if($operation !== 'create'){
                            return false;
                        }
                        if(!app()->environment('local')){
                            return false;
                        }
                        return true;
                    })
                    ->action(function ($livewire) {
                        $data = Customer::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ]),

        ];
    }
}
