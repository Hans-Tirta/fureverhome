<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Pet;
use App\Models\User;

class PetPolicy
{
    /**
     * Determine whether the user can view any models.
     * Public dapat melihat daftar pets, shelter/admin dapat melihat pets mereka
     */
    public function viewAny(?User $user): bool
    {
        // Everyone can view public pet listings
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * Semua orang bisa melihat detail pet
     */
    public function view(?User $user, Pet $pet): bool
    {
        // Everyone can view individual pet details
        return true;
    }

    /**
     * Determine whether the user can create models.
     * Hanya shelter yang bisa create pets
     */
    public function create(User $user): bool
    {
        return $user->isShelter();
    }

    /**
     * Determine whether the user can update the model.
     * Shelter hanya bisa update pets milik mereka
     */
    public function update(User $user, Pet $pet): bool
    {
        // Only shelter can update their own pets
        if ($user->isShelter()) {
            // Check if shelter relationship exists
            if (!$user->shelter) {
                return false;
            }
            return $pet->shelter_id === $user->shelter->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     * Same rules as update
     */
    public function delete(User $user, Pet $pet): bool
    {
        // Same logic as update
        return $this->update($user, $pet);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pet $pet): bool
    {
        return $this->update($user, $pet);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pet $pet): bool
    {
        // Only admin can force delete
        return $user->isAdmin();
    }

    /**
     * Custom policy for managing pets (shelter dashboard)
     */
    public function manage(User $user, Pet $pet): bool
    {
        return $this->update($user, $pet);
    }
}
