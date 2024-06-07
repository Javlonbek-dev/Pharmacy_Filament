<?php

namespace Database\Factories;

use App\Models\Medication;
use App\Models\Prescription;
use App\Models\Prescription_Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class Prescription_ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prescription_Item::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'prescription_id' => Prescription::factory(),
            'medication_id' => Medication::factory(),
            'quantity' => $this->faker->numberBetween(1, 10000),
            'dosage' => $this->faker->numberBetween(10000, 10000),
            'frequency' => $this->faker->numberBetween(10000, 10000),
        ];
    }
}
