<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User has one Shelter (only for shelter role)
    public function shelter(): HasOne
    {
        return $this->hasOne(Shelter::class);
    }

    // User has many Adoptions (as adopter)
    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    // User has many Sponsorships (as donor)
    public function sponsorships(): HasMany
    {
        return $this->hasMany(Sponsorship::class);
    }

    // User has many Platform Donations
    public function platformDonations(): HasMany
    {
        return $this->hasMany(PlatformDonation::class);
    }

    // User has many Articles (as author - only admin)
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isShelter(): bool
    {
        return $this->role === 'shelter';
    }

    public function isAdopter(): bool
    {
        return $this->role === 'adopter';
    }
}
