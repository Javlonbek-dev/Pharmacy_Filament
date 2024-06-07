<?php

namespace App\Models;

use App\Enums\Status;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'order_date',
        'total_amount',
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
        'order_date' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function billing(): HasOne
    {
        return $this->hasOne(Billing::class);
    }

    public function received(): void
    {
        $this->status = Status::Received;

        $this->save();
    }

    public function cancelled(): void
    {
        $this->status = Status::Cancelled;

        $this->save();
    }
    public static function getForm()
    {
        return [
            Select::make('customer_id')
                ->relationship('customer.user', 'name'),
            DatePicker::make('order_date')
                ->required(),
            TextInput::make('total_amount')
                ->required()
                ->numeric(),
            Select::make('status')
                ->required()
                ->enum(Status::class)
                ->options(Status::class),
            Actions::make([
                Action::make('star')
                    ->icon('heroicon-m-star')
                    ->label('Fill  with Factory data')
                    ->color('info')
                    ->action(function ($livewire) {
                        $data = Order::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ])
        ];
    }
}
