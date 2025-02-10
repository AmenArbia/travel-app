<?php

namespace Database\Seeders;
use Database\Seeders\CountrySeeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\ChaineSeeder;
use Database\Seeders\AmenitiesTableSeeder;
use Database\Seeders\HotelSeeder;
use Database\Seeders\RoomSeeder;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([

                //BookingSeeder::class,

            CountrySeeder::class,
            CitySeeder::class,
            ChaineSeeder::class,
            AmenitiesTableSeeder::class,
            HotelSeeder::class,
            RoomSeeder::class,
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}