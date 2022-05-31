<?php

namespace Database\Factories;

use App\Models\Town;
use App\Models\User;
use App\Models\Promote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Space>
 */
class SpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'town_id' => Town::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'district' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'promote_id' => Promote::all()->random()->id,
            'longitude' => $this->faker->latitude($min = -90, $max = 90),
            'latitude' => $this->faker->longitude($min = -180, $max = 180),
            'etat' => 1
        ];
    }
}
