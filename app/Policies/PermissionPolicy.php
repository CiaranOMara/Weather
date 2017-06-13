<?php

namespace App\Policies;

use App\User;
use App\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the permission.
     *
     * @param  \App\User $user
     * @param  \App\Permission $permission
     * @return mixed
     */
    public function view(User $user, Permission $permission = null)
    {
        return $user->hasPermission('permissions.view');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('permissions.create');
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\User $user
     * @param  \App\Permission $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission)
    {
        if ($permission->permanent) {
            return false;
        }

        return $user->hasPermission('permissions.update');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\User $user
     * @param  \App\Permission $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission)
    {
        if ($permission->permanent) {
            return false;
        }

        return $user->hasPermission('permissions.delete');
    }
}
