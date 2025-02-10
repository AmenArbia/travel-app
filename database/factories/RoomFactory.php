<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Room::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'pax_capacity' => [
                'pax_min' => $this->faker->numberBetween(1, 4),
                'pax_max' => $this->faker->numberBetween(0, 2),
            ],
            'adult_capacity' => [
                'adult_min' => $this->faker->numberBetween(1, 4),
                'adult_max' => $this->faker->numberBetween(0, 2),
            ],
            'children_capacity' => [
                'children_max' => $this->faker->numberBetween(0, 2),
            ],
            'infants_capacity' => [
                'infants_max' => $this->faker->numberBetween(0, 2),
            ],
            'extra_capacity' => [
                'extra_bed_max' => $this->faker->numberBetween(1, 4),
                'extra_children_max' => $this->faker->numberBetween(0, 2),
                'extra_cots_max' => $this->faker->numberBetween(0, 2),
            ],
            'type' => $this->faker->randomElement(['Standard ', 'Deluxe ', 'Suite ']),
        ];
    }
}