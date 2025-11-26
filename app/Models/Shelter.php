<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shelter extends Model
{
    /** @use HasFactory<\Database\Factories\ShelterFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'email',
        'description',
        'website',
        'logo',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    // Shelter belongs to one User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Shelter has many Pets
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    // Shelter has many Adoptions
    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    // Shelter has many Sponsorships
    public function sponsorships(): HasMany
    {
        return $this->hasMany(Sponsorship::class);
    }
}
