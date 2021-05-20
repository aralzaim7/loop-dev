<?php

namespace Database\Factories;

use App\Models\OpeningHour;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpeningHourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OpeningHour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'room_type_id'=> '1',
            'day'=>strtolower($this->faker->dayOfWeek),
            'start_time'=>'09:00',
            'end_time'=>'17:00'
        ];
    }
}
