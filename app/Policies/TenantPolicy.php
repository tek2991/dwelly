<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
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
        return $user->hasRole('admin') || $user->hasPermissionTo('view tenants');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Tenant $tenant)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('view tenants');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('add tenants');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Tenant $tenant)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('edit tenants');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Tenant $tenant)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('delete tenants');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Tenant $tenant)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Tenant $tenant)
    {
        //
    }
}
