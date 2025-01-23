<?php

namespace App\Policies;

use App\Models\Onboarding;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OnboardingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('view onboarding');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Onboarding  $onboarding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Onboarding $onboarding)
    {
        return $user->hasRole('admin') || ($user->hasPermissionTo('view onboarding') && $user->id == $onboarding->task->assigned_to);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('add onboarding');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Onboarding  $onboarding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Onboarding $onboarding)
    {
        return $user->hasRole('admin') || ($user->hasPermissionTo('edit onboarding') && $user->id == $onboarding->task->assigned_to);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Onboarding  $onboarding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Onboarding $onboarding)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('delete onboarding');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Onboarding  $onboarding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Onboarding $onboarding)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Onboarding  $onboarding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Onboarding $onboarding)
    {
        //
    }
}
