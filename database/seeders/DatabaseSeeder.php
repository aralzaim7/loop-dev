<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\ReservationCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Aral',
            'last_name' => 'Zaim',
            'email' => 'aralzaim7@gmail.com',
            'password' => Hash::make('aralezgi123'),
            'phone' => '05338405569',
            'address' => 'Sehit Kutsi Ilhan Sokak, Hancerli Apt',
            'country' => 'cy',
            'city' => 'Lefkosa'
        ]);

        Reservation::create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'Test Title',
            'room_type' => 'atolye',
            'reservation_date' => '2021-05-06',
            'reservation_start_time' => '16:30:00',
            'reservation_end_time' => '17:30:00',
            'status' => 'pending',
        ]);

        ReservationCategory::create([
            'name' => 'uretim',
            'cost_per_hour' => '30.00',
        ]);
    }
}
