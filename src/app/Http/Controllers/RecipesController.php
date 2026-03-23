<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use App\Http\Requests\RecipesRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipesController extends Controller
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
    public function store(RecipesRequest $request)
    {
        Recipes::create([
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
    public function show(Recipes $recipes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipes $recipes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipesRequest $request, Recipes $recipes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipes $recipes)
    {
        //
    }
}
