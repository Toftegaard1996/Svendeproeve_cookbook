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

        $guide = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec neque ut ex sodales suscipit nec vel libero. Suspendisse imperdiet ipsum quam, in porttitor nunc pretium in. Ut et mollis ex. Ut a ex eu libero faucibus rhoncus. Curabitur tempor dolor vitae sagittis congue. Praesent ligula eros, luctus vitae iaculis quis, consequat nec diam. In vehicula magna sit amet est scelerisque, non bibendum arcu ultrices. Aenean eget neque eget justo iaculis lobortis eget id lacus. Praesent semper purus lorem, sed commodo mauris mollis a. Sed quis semper leo. Fusce tempus placerat felis, in fermentum dolor efficitur in. Sed sodales tellus quis pharetra auctor. In ac tortor orci.

Praesent feugiat laoreet nulla. Sed sed odio facilisis, scelerisque sapien eu, malesuada est. Ut fringilla tortor sit amet maximus gravida. Quisque pretium mauris eu tincidunt vulputate. Nam a diam aliquam, venenatis felis sed, bibendum magna. In quis mattis massa, eget dapibus dolor. Praesent viverra libero id risus malesuada posuere. Duis rutrum turpis non interdum rhoncus.

Nulla eleifend, diam in eleifend porta, felis sem dictum ligula, vitae facilisis dolor ex viverra orci. Aenean aliquet neque quis metus vestibulum lacinia. Sed lacus libero, porta nec eros quis, tincidunt fermentum enim. Nunc eget nulla at tellus posuere lobortis vel et arcu. Nam felis risus, cursus non maximus a, rhoncus nec nibh. Curabitur vel ipsum sed urna tempor sagittis. Integer interdum varius gravida. Proin ornare urna quis augue tincidunt consectetur. Nullam dictum libero eu risus scelerisque, at aliquam neque consequat. Integer rhoncus lacus ac venenatis venenatis. Quisque vel malesuada neque. Morbi in magna aliquet, faucibus arcu in, ornare augue. Duis et sapien facilisis, accumsan mauris et, sagittis velit.";
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $recipes = Recipe::factory(24)->create();
        $validRecipe = Recipe::factory()->create([
            'name' => 'Lasagne',
            'description' => 'Verdens bedste lasagne',
            'cook_time' => 55,
            'base_amount' => 4,
            'guide' => $guide,
        ]);
        $ingredients = Ingredient::factory(10)->create();
        $courses = Course::factory(3)->create();
        $categories = Category::factory(10)->create();

        foreach ($recipes as $recipe) {
            $recipe->ingredients()->syncWithPivotValues($ingredients, [
                'measurements' => random_int(1, 1000),
                'unit' => fake()->randomElement(['liter','deciliter', 'stk', 'dåse', 'spiseske','teske', 'slat','skvulp','skvis', 'gr', 'kg'])]);
            $recipe->courses()->syncWithPivotValues($courses, []);
            $recipe->categories()->syncWithPivotValues($categories, []);
        }
        $user->recipes()->syncWithPivotValues($recipes, ['notes' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec neque ut ex sodales suscipit nec vel libero']);

        $validRecipe->ingredients()->syncWithPivotValues($ingredients, [
            'measurements' => random_int(1, 1000),
            'unit' => fake()->randomElement(['liter','deciliter', 'stk', 'dåse', 'spiseske','teske', 'slat','skvulp','skvis', 'gr', 'kg'])]);
        $validRecipe->courses()->syncWithPivotValues($courses, []);
        $validRecipe->categories()->syncWithPivotValues($categories, []);
//        $user->recipes()->syncWithPivotValues($validRecipe, ['notes' => "I min ovn, skal lasagnen kun have 15 min."]);
    }
}

