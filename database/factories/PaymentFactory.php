<?php

namespace Database\Factories;

use App\Enums\Payment_Method;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Payment;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'payment_date' => $this->faker->date(),
            'payment_method' => $this->faker->randomElement(Payment_Method::class),
            'amount' => $this->faker->numberBetween(1, 10000),
        ];
    }
}
