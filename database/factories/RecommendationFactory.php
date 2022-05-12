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
            'note' => $this->faker->numberBetween(1,5),
            'content' => $this->faker->paragraph(6),
            'etat' => 1
        ];
    }
}
