<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\RecipesController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'auth/Login', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::resource('/recipes', RecipesController::class);
    Route::resource('/categories', CategoriesController::class)->only(['index', 'show', 'destroy']);
});

require __DIR__.'/settings.php';
