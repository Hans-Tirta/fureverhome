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
        'parent_id',
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

    // Parent Category (self-referencing)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Child Categories (subcategories)
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Check if category is a main category (has no parent)
    public function isMain(): bool
    {
        return $this->parent_id === null;
    }
}
