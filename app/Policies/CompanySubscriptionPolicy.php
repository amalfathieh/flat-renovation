<?php

namespace App\Policies;

use App\Models\CompanySubscription;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\Response;

class CompanySubscriptionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_companysubscription');

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CompanySubscription $companySubscription): bool
    {
        return $user->can('view_companysubscription');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'admin'){
            return false;
        }
        if (Filament::getCurrentPanel()->getId() == 'company') {
            return $user->can('create_companysubscription');
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CompanySubscription $companySubscription): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CompanySubscription $companySubscription): bool
    {
        return false;
    }

}
