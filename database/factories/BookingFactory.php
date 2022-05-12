<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Space;
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
    public function definition()
    {
        return [
           'user_id' => User::all()->random()->id,
            'space_id' => Space::all()->random()->id,
            'arrived_date' => $this->faker->date(),
            'departure_date' => $this->faker->date(),
            'number_of_adults' => $this->faker->numberBetween(1,5),
            'number_of_children' => $this->faker->numberBetween(1,5),
            'phone' => $this->faker->phoneNumber(),
            'status' => "encouring",
            'booked_at' => $this->faker->date(),
            'etat' => 1
        ];
    }
}
