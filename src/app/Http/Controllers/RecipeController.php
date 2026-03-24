<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('recipes/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeRequest $request)
    {
        Recipe::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'cook_time' => $request->input('cook_time'),
            'base_amount' => $request->input('base_amount'),
            'guide' => $request->input('guide'),
            'country' => $request->input('country'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipesRequest $request, Recipe $recipes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipes)
    {
        //
    }
}
