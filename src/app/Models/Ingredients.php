<?php

namespace App\Models;

use Database\Factories\IngredientsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredients extends Model
{
    /** @use HasFactory<IngredientsFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipes::class, 'ingredient_recipe')
            ->withPivot('measurements', 'unit')
            ->withTimestamps();
    }
}
