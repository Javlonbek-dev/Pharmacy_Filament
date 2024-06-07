<?php

namespace Database\Factories;

use App\Models\Medication;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'medication_id' => Medication::factory(),
            'quantity' => $this->faker->numberBetween(10000, 10000),
            'price' => $this->faker->numberBetween(10000, 100000),
        ];
    }
}
