<?php

namespace App\Policies;

use App\Models\Objection;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\Response;

class ObjectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('view_any_objection');
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Objection $objection): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('view_objection');
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Objection $objection): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Objection $objection): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('delete_objection');
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Objection $objection): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Objection $objection): bool
    {
        return false;
    }
}
