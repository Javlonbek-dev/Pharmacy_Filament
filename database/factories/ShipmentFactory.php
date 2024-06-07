<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Shipment;
use App\Models\Supplier;

class ShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'supplier_id' => Supplier::factory(),
            'shipment_date' => $this->faker->date(),
            'received_date' => $this->faker->date(),
            'status' => $this->faker->word(),
        ];
    }
}
