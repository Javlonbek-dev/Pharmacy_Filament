<?php

namespace Database\Factories;

use App\Enums\BillingStatus;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Billing::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'order_id' => Order::factory(),
            'total_amount' => $this->faker->numberBetween(10000, 100000),
            'billing_date' => $this->faker->date(),
            'status' => $this->faker->boolean,
        ];
    }
}
