<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Adoption;
use App\Models\User;

class AdoptionPolicy
{
    /**
     * Determine whether the user can view any models.
     * Only shelter can view their adoption requests list
     */
    public function viewAny(User $user): bool
    {
        // Only shelter can view adoption requests
        return $user->isShelter();
    }

    /**
     * Determine whether the user can view the model.
     * Adopter can view their own, shelter can view for their pets
     */
    public function view(User $user, Adoption $adoption): bool
    {
        // Adopter can view their own adoption requests
        if ($user->isAdopter() && $adoption->user_id === $user->id) {
            return true;
        }

        // Shelter can view adoptions for their pets
        if ($user->isShelter() && $user->shelter) {
            return $adoption->pet->shelter_id === $user->shelter->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     * Only adopters can create adoption requests
     */
    public function create(User $user): bool
    {
        return $user->isAdopter();
    }

    /**
     * Determine whether the user can update the model.
     * Only shelter owner can update (approve/reject)
     */
    public function update(User $user, Adoption $adoption): bool
    {
        // Only shelter can update adoptions for their pets
        if ($user->isShelter() && $user->shelter) {
            return $adoption->pet->shelter_id === $user->shelter->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     * Only the adopter can cancel their own pending request
     */
    public function delete(User $user, Adoption $adoption): bool
    {
        // Only adopter can cancel their own pending request
        return $user->isAdopter()
            && $adoption->user_id === $user->id
            && $adoption->status === 'pending';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Adoption $adoption): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Adoption $adoption): bool
    {
        // Only admin can force delete
        return $user->isAdmin();
    }

    /**
     * Custom policy for viewing adopter's own requests
     */
    public function viewOwn(User $user): bool
    {
        return $user->isAdopter();
    }
}
