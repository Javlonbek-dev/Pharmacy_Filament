<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\;
use App\Models\Shipment;
use App\Models\ShipmentItem;

class ShipmentItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShipmentItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'shipment_id' => Shipment::factory(),
            'medication_id' => ::factory(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'cost_price' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
