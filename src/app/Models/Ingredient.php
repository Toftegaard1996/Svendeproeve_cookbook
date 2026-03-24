<?php

namespace App\Models;

use Database\Factories\IngredientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    /** @use HasFactory<IngredientFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'ingredient_recipe')
            ->withPivot('measurements', 'unit')
            ->withTimestamps();
    }
}
