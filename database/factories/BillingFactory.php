<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\;
use App\Models\Billing;
use App\Models\Customer;

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
            'order_id' => ::factory(),
            'total_amount' => $this->faker->numberBetween(-10000, 10000),
            'billing_date' => $this->faker->date(),
            'status' => $this->faker->word(),
        ];
    }
}
