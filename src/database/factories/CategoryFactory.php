<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Pasta', 'Beef', 'Pork', 'Veggies', 'Cake', 'Chicken', 'Soup', 'Potatoes', 'Fish', 'Pie', 'Muffins', 'Bread', 'Burger', 'Steak', 'Root vegetable', 'Tacos']),
//            'name' => $this->faker->unique()->word(),
        ];
    }
}
