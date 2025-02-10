<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = City::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'country_id' => $this->faker->numberBetween(1, 10),
            'country_name' => function (array $attributes) {
                return Country::find($attributes['country_id'])->name;
            }
        ];
    }
}