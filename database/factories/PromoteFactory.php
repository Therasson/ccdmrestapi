<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promote>
 */
class PromoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //$name = $this->faker->name;
        return [
            'name' => $this->faker->name,
            'slug' => Str::slug($this->faker->name),
            'etat' => 1
        ];
    }
}
