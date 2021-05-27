<?php

namespace Database\Factories;

use App\Models\OpeningHour;
use App\Models\Reservation;
use App\Models\ReservationCategory;
use App\Models\RoomType;
use Carbon\Carbon;
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
    public function definition(): array
    {
        return [
            'user_id' => '1',
            'category_id' => ReservationCategory::factory(),
            'title' => $this->faker->text(20),
            'room_type_id' => RoomType::factory(),
            'reservation_date' => $this->faker->dateTimeBetween('now','1 months')->format('Y-m-d'),
            'reservation_start_time' => Carbon::parse($this->faker->time('H:i'))->startOfHour(),
            'reservation_end_time' => Carbon::parse($this->faker->time('H:i'))->startOfHour(),
            'status' => 'pending',

        ];
    }
}
