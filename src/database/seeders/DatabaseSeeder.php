<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $recipes = Recipe::factory(50)->create();
        $ingredients = Ingredient::factory(10)->create();
        $courses = Course::factory(10)->create();
        $categories = Category::factory(10)->create();

        foreach ($recipes as $recipe) {
            $user->recipes()->syncWithPivotValues($recipe, ['notes' => Str::random(100)]);
            $recipe->ingredients()->syncWithPivotValues($ingredients, ['measurements' => random_int(1, 1000), 'unit' => Str::random(10)]);
            $recipe->courses()->syncWithPivotValues($courses, []);
            $recipe->categories()->syncWithPivotValues($categories, []);
        }
    }
}
