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
        User::factory([
            'first_name' => 'Aral',
            'last_name' => 'Zaim',
            'email' => 'aralzaim7@gmail.com',
            'password' => Hash::make('aralezgi123'),
            'phone' => '05338405569',
            'address' => 'Sehit Kutsi Ilhan Sokak, Hancerli Apt',
            'country' => 'cy',
            'city' => 'Lefkosa',
            'is_admin' => true

        ])->has(Reservation::factory()->count(25))
            ->create();

        User::factory([
            'email' => 'test@gmail.com',
            'password' => Hash::make('test'),
            'is_admin' => false
        ])->has(Reservation::factory()->count(25))
            ->create();

        User::factory()->count(25)
            ->has(Reservation::factory()->count(5))
            ->create();


    }
}
