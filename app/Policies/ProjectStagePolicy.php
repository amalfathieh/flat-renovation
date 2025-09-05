<?php

namespace App\Policies;

use App\Models\ProjectStage;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\Response;

class ProjectStagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('view_any_projectstage');
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProjectStage $projectStage): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('view_projectstage');
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('create_projectstage');
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProjectStage $projectStage): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('update_projectstage');
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProjectStage $projectStage): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'company'){
            return $user->can('delete_projectstage');
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProjectStage $projectStage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProjectStage $projectStage): bool
    {
        return false;
    }
}
