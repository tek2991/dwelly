<?php

namespace App\Policies;

use App\Models\Furniture;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FurniturePolicy
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
        return $user->hasRole('admin') || $user->hasPermissionTo('view furniture');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Furniture $furniture)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('view furniture');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('add furniture');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Furniture $furniture)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('edit furniture');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Furniture $furniture)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('delete furniture');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Furniture $furniture)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Furniture $furniture)
    {
        //
    }
}
