<?php

namespace App\Policies;

use App\Models\ExternalTransfer;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\Response;

class ExternalTransferPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('admin_view_any_externaltransfer');

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExternalTransfer $externalTransfer): bool
    {
        return $user->can('admin_view_externaltransfer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'admin'){
            return $user->can('admin_create_externaltransfer');
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExternalTransfer $externalTransfer): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'admin'){
            return $user->can('admin_update_externaltransfer');
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExternalTransfer $externalTransfer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ExternalTransfer $externalTransfer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ExternalTransfer $externalTransfer): bool
    {
        return false;
    }
}
