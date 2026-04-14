<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class InspirationController extends Controller
{
    public function index()
    {
        $randomRecipe = Http::get('www.themealdb.com/api/json/v1/1/random.php')['meals'];
        return Inertia::render('inspiration/Index', ['randomRecipe' => $randomRecipe]);
    }
}
