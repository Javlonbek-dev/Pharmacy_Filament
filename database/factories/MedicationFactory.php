<?php

namespace Database\Factories;

use App\Enums\Dosage_Form;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Medication;

class MedicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medication::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'manufacturer' => $this->faker->word(),
            'dosage_form' => $this->faker->randomElement(Dosage_Form::class),
            'strength' => $this->faker->word(),
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
