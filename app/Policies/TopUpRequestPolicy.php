<?php

namespace App\Policies;

use App\Models\TopUpRequest;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\Response;

class TopUpRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_topuprequest');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TopUpRequest $topUpRequest): bool
    {
        return $user->can('view_topuprequest');

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_topuprequest');

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TopUpRequest $topUpRequest): bool
    {
        return $user->can('update_topuprequest');
    }

}
