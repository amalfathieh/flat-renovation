<?php

namespace App\Policies;

use App\Models\SubscriptionPlan;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\Response;

class SubscriptionPlanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_subscriptionplan');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SubscriptionPlan $subscriptionPlan): bool
    {
        return $user->can('view_subscriptionplan');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'admin'){
            return $user->can('admin_create_subscriptionplan');
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubscriptionPlan $subscriptionPlan): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'admin'){
            return $user->can('admin_update_subscriptionplan');
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubscriptionPlan $subscriptionPlan): bool
    {
        if (Filament::getCurrentPanel()->getId() == 'admin'){
            return $user->can('admin_delete_subscriptionplan');
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SubscriptionPlan $subscriptionPlan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SubscriptionPlan $subscriptionPlan): bool
    {
        return false;
    }
}
