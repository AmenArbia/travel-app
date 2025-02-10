<?php

namespace Database\Factories;

use App\Models\Amenities;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amenities>
 */
class AmenitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Amenities::class;
    public function definition(): array
    {
        return [
            'title' => [
                'en' => $this->faker->word,
                'fr' => $this->faker->word,
            ],
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['Instant', 'Internet', 'Kitchen', 'Bedroom', 'Living Area', 'Media and Technology']),
            'status' => 'Active',
            'room_id' => Room::factory(),
        ];
    }
}