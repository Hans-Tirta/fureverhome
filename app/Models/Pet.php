<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    /** @use HasFactory<\Database\Factories\PetFactory> */
    use HasFactory;

    protected $fillable = [
        'shelter_id',
        'category_id',
        'name',
        'age',
        'gender',
        'size',
        'color',
        'breed',
        'description',
        'health_status',
        'vaccination_status',
        'is_available',
        'image',
        'adopted_at',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'age' => 'integer',
    ];

    // Pet belongs to Shelter
    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    // Pet belongs to Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Pet has many Images
    public function images(): HasMany
    {
        return $this->hasMany(PetImage::class);
    }

    // Pet has many Adoptions
    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }
}
