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

    public function monday(): OpeningHourFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'day' => 'monday',
                'end_time' => '12:00',
            ];
        });
    }
    public function tuesday(): OpeningHourFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'day' => 'tuesday',
                'end_time' => '13:00',
            ];
        });
    }

    public function wednesday(): OpeningHourFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'day' => 'wednesday',
                'end_time' => '14:00',
            ];
        });
    }

    public function thursday(): OpeningHourFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'day' => 'thursday',
                'end_time' => '15:00',
            ];
        });
    }

    public function friday(): OpeningHourFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'day' => 'friday',
                'end_time' => '16:00',
            ];
        });
    }
    public function saturday(): OpeningHourFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'day' => 'saturday',
                'start_time' => null,
                'end_time' => null,
            ];
        });
    }
    public function sunday(): OpeningHourFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'day' => 'sunday',
                'start_time' => null,
                'end_time' => null,
            ];
        });
    }


}
