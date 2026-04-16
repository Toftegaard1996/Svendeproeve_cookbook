<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class AllRecipesController extends Controller
{
    public function index()
    {
        return Inertia::render('allRecipes/Index', ['recipes' => Recipe::all()]);
    }
}
