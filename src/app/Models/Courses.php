<?php

namespace App\Models;

use Database\Factories\CoursesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Courses extends Model
{
    /** @use HasFactory<CoursesFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipes::class, 'course_recipe')->withTimestamps();
    }
}
