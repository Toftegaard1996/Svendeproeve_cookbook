<?php

use App\Http\Controllers\AllRecipesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InspirationController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'auth/Login', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/recipe', RecipeController::class);
    Route::resource('/category', CategoryController::class)->only(['index', 'store', 'destroy']);
    Route::get("/pdf/{recipe}/{number}", [RecipeController::class, "convertToPdf"])->name("pdf");
    Route::get("/inspiration", [InspirationController::class, "index"])->name("inspiration");
    Route::get("/allRecipes", [AllRecipesController::class, "index"])->name("allRecipes");
});

require __DIR__.'/settings.php';
