<?php

namespace Database\Factories;

use App\Models\Space;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recommendation>
 */
class RecommendationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'space_id' => Space::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'score' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph,
            'etat' => 1,
        ];
    }
}
