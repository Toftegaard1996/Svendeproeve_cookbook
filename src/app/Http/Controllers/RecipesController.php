<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use App\Http\Requests\RecipesRequest;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipesRequest $request)
    {
        //
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
