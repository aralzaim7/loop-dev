<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\ReservationCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => '1',
            'category_id' => ReservationCategory::factory(),
            'title' => $this->faker->text(20),
            'room_type' => $this->faker->text(10),
            'reservation_date' => $this->faker->dateTimeBetween('now','1 years')->format('Y-m-d'),
            'reservation_start_time' => $this->faker->time('H:i'),
            'reservation_end_time' => $this->faker->time('H:i'),
            'status' => 'pending',

        ];
    }
}
