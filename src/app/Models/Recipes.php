<?php

namespace App\Models;

use Database\Factories\RecipesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipes extends Model
{
    /** @use HasFactory<RecipesFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cook_time',
        'base_amount',
        'guide',
        'country',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Categories::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Courses::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredients::class);
    }
}
