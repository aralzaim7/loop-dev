<?php

namespace Database\Factories;

use App\Models\ReservationCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReservationCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'cost_per_hour' => $this->faker->randomDigit(),
        ];
    }
}
