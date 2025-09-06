<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\Response;

class ServicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('view_any_service');
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Service $service): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('view_service');
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('create_service');
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $service): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('update_service');
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $service): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('delete_service');
        }
        return false;
    }

}
