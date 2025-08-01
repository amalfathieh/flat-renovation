<?php

namespace App\Policies;

use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ServiceTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('supervisor') || $user->hasRole('company');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ServiceType $serviceType): bool
    {
        return $user->hasRole('supervisor') || $user->hasRole('company');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('supervisor') || $user->hasRole('company');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ServiceType $serviceType): bool
    {
        return $user->hasRole('supervisor') || $user->hasRole('company');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ServiceType $serviceType): bool
    {
        return $user->hasRole('company');
    }

}
