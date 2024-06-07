<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Pharmacist;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prescription::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'pharmacist_id' => Pharmacist::factory(),
            'prescription_date' => $this->faker->date(),
            'doctor_name' => $this->faker->word(),
            'total_amount' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
