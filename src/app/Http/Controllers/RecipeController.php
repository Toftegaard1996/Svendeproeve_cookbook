<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRecipeRequest;
use App\Lib\Feedback;
use App\Lib\Pdf;
use App\Models\Category;
use App\Models\Course;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use Gotenberg\Gotenberg;
use Gotenberg\Stream;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Dashboard', [
            'recipes' => $request->user()->recipes()->with('courses')->with('categories')->with('ingredients')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('recipes/Create', [
            'categories' => Category::all(),
            'courses' => Course::all(),
            'ingredients' => Ingredient::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        $recipe = Recipe::create([
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? null,
            'cook_time' => $request->input('cook_time') ?? null,
            'base_amount' => $request->input('base_amount'),
            'guide' => $request->input('guide') ?? "",
            'country' => $request->input('country') ?? null,
        ]);

        //Create attachment between user and recipe
        $request->user()->recipes()->attach($recipe->id, [
            'notes' => $request->input('notes'),
        ]);

        //Create attachment between recipe and categories
        if (!empty($request->input('categories'))) {
            $recipe->categories()->sync($request->input('categories'));
        }
        if (!empty($request->input('courses'))) {
            $recipe->courses()->sync($request->input('courses'));
        }

        if (!empty($request->input('ingredients'))) {
            foreach ($request->input('ingredients') as $ingredient) {
                $recipe->ingredients()->attach($ingredient['ingredient'], [
                    'measurements' => $ingredient['measurement'] ?? null,
                    'unit' => $ingredient['unit'] ?? null,
                ]);
            }
        }

        Feedback::notification('Opskrift oprettet');
        return redirect()->route('recipe.show', ['recipe' => $recipe]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Recipe $recipe)
    {
//        dd([
//            'full_url' => $request->fullUrl(),
//            'route_params' => $request->route()->parameters(),
//            'recipe' => $recipe,
//            'recipe_id' => $recipe->id,
//        ]);
        return Inertia::render('recipes/Show', [
            'recipe' => $request->user()->recipes()
                ->with(['courses', 'categories', 'ingredients'])
                ->where('recipe_id', $recipe->id)
                ->firstOrFail()
        ]);
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
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $request->user()->recipes()->updateExistingPivot($recipe->id, [
            'notes' => $request->input('notes'),
        ]);

//        Feedback::notification('Rating, ejerskab og læsedage opdateret');
        return redirect()->route('recipe.show', ['recipe' => $recipe]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Recipe $recipe)
    {
        $request->user()->recipes()->detach($recipe->id);

        return redirect()->route('recipe.index');
    }

    public function convertToPdf(Request $request, Recipe $recipe): Response
    {
        $fileName = Pdf::nameConversion($recipe->name);
        $recipeWithPivots = $request->user()->recipes()
            ->with(['courses', 'categories', 'ingredients'])
            ->where('recipe_id', $recipe->id)
            ->firstOrFail();
        $imageName = $recipe->image_name ?? '';
        $pdf = Pdf::render(view('pdf.index', ['recipe' => $recipeWithPivots]), $imageName);

        return Pdf::response($pdf, $fileName);
    }
}
