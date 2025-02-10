<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\TypeRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'hotel_id' => Hotel::factory(),
            'roomtype_id' => TypeRoom::factory(),
            'check_in_date' => $this->faker->date(),
            'check_out_date' => $this->faker->date(),
            'capacity' => $this->faker->numberBetween(1, 5),
            'adults' => $this->faker->numberBetween(1, 4),
            'children' => $this->faker->numberBetween(0, 3),
            'infants' => $this->faker->numberBetween(0, 2),
            'price_per_night' => $this->faker->randomFloat(2, 50, 500),
            'total_price' => $this->faker->randomFloat(2, 100, 2000),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => [
                'street' => $this->faker->streetAddress,
                'city' => $this->faker->city,
                'country' => $this->faker->country,
            ],
            'coupon_code' => $this->faker->optional()->word,
            'country_id' => Country::factory(),
            'city_id' => City::factory(),
            'room_id' => Room::factory(),
            'booking_status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'is_confirmed' => $this->faker->boolean,
        ];
    }
}
