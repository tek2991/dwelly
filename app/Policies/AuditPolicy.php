<?php

namespace App\Policies;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuditPolicy
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
        return $user->hasRole('admin') || $user->hasPermissionTo('view audit');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Audit $audit)
    {
        return $user->hasRole('admin') || ($user->hasPermissionTo('view audit') && $user->id == $audit->task->assigned_to);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('add audit');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Audit $audit)
    {
        return $user->hasRole('admin') || ($user->hasPermissionTo('edit audit') && $user->id == $audit->task->assigned_to);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Audit $audit)
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('delete audit');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Audit $audit)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Audit $audit)
    {
        //
    }


    public function verifyAudit(User $user, Audit $audit)
    {
        // Ensure the audit is not completed
        if ($audit->completed) {
            return false;
        }

        // Ensure the related task has a `task_state_id` of 3
        if ($audit->task->task_state_id !== 3) {
            return false;
        }

        // Check if the user has the 'admin' role or the 'verify audit' permission
        if ($user->hasRole('admin') || $user->hasPermissionTo('verify audit')) {
            return true;
        }

        // Default to denying the action
        return false;
    }
}
