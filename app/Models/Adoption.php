<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adoption extends Model
{
    /** @use HasFactory<\Database\Factories\AdoptionFactory> */
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'user_id',
        'shelter_id',
        'status',
        'reason',
        'experience',
        'living_situation',
        'notes',
        'admin_notes',
        'applied_at',
        'responded_at',
        'completed_at',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
        'responded_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }
}
