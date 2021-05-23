<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\OpeningHour;
use App\Models\ReservationCategory;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoomType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(6)
        ];
    }

    public function configure(): RoomTypeFactory
    {
        return $this->afterCreating(function (RoomType $roomType) {

            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

            foreach ($days as $day) {
                OpeningHour::factory([
                    'room_type_id' => $roomType->id
                ])->$day()->create();
            }
        });
    }

}
