<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'cook_time' => $this->faker->numberBetween(1, 120),
            'base_amount' => $this->faker->numberBetween(1, 10),
            'guide' => $this->faker->text(),
            'country' => $this->faker->country(),
        ];
    }
}
