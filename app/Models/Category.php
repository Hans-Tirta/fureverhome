<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
    ];

    // Category has many Pets
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    // Category has many Articles
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
