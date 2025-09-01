<?php

namespace App\Policies;

use App\Models\TopUpRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TopUpRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('company') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TopUpRequest $topUpRequest): bool
    {
        return $user->hasRole('company') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('company');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TopUpRequest $topUpRequest): bool
    {
        return $user->hasRole('admin');
    }

}
