<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'auth/Login', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/recipe', RecipeController::class);
    Route::resource('/category', CategoryController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__.'/settings.php';
