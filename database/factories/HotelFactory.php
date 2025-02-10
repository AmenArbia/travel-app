<?php

namespace Database\Factories;

use App\Models\Chaine;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Hotel::class;

    public function definition()
    {
        return [
            'name' => [
                'en' => $this->faker->company,
                'ar' => $this->faker->company,
            ],
            'slug' => $this->faker->slug,
            'description' => [
                'en' => $this->faker->paragraph,
                'ar' => $this->faker->paragraph,
            ],
            'emails' => $this->faker->unique()->safeEmail,
            'contact' => [
                'tel' => $this->faker->phoneNumber,
                'nom' => $this->faker->name,
            ],
            'status' => $this->faker->randomElement(['actif', 'en maintenance', 'fermé']),
            'type_hotel' => $this->faker->randomElement(['Guest House', 'Resort', 'Hotel']),
            'chaine_id' => Chaine::inRandomOrder()->first()->id,
            'country_id' => Country::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'longitude' => $this->faker->longitude,
            'street' => $this->faker->streetAddress,
        ];
    }
}