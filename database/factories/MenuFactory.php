<?php

namespace Database\Factories;

use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
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
            'space_id' => Space::all()->random()->id,
            'number_of_person' => $this->faker->randomNumber(2, false),
            'prix' => $this->faker->randomNumber(4, false),
            'description' => $this->faker->paragraph,
            'etat'=> 1
        ];
    }
}
