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
        'age_years',
        'age_months',
        'gender',
        'size',
        'breed',
        'color',
        'description',
        'medical_history',
        'health_status',
        'vaccination_status',
        'is_neutered',
        'is_house_trained',
        'good_with_kids',
        'good_with_pets',
        'adoption_fee',
        'is_available',
        'image',
        'adopted_at',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_neutered' => 'boolean',
        'is_house_trained' => 'boolean',
        'good_with_kids' => 'boolean',
        'good_with_pets' => 'boolean',
        'age_years' => 'integer',
        'age_months' => 'integer',
        'adoption_fee' => 'decimal:2',
        'adopted_at' => 'datetime',
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

    /**
     * Get formatted age string
     */
    public function getFormattedAgeAttribute(): string
    {
        $years = $this->age_years;
        $months = $this->age_months;

        if ($years > 0 && $months > 0) {
            return "{$years} year(s) {$months} month(s)";
        } elseif ($years > 0) {
            return "{$years} year(s)";
        } elseif ($months > 0) {
            return "{$months} month(s)";
        } else {
            return "Under 1 month";
        }
    }

    /**
     * Get total age in months
     */
    public function getTotalAgeInMonthsAttribute(): int
    {
        return ($this->age_years * 12) + $this->age_months;
    }
}
