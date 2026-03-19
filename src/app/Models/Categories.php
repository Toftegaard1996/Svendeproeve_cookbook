<?php

namespace App\Models;

use Database\Factories\CategoriesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categories extends Model
{
    /** @use HasFactory<CategoriesFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipes::class, 'category_recipe')->withTimestamps();
    }
}
