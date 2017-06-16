<?php

namespace App\Policies;

use App\Permission;
use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermission('roles.view');
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('roles.create');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        if ($role->permanent) {
            return false;
        }

        return $user->hasPermission('roles.update');
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        if ($role->permanent) {
            return false;
        }

        return $user->hasPermission('roles.delete');
    }

    /**
     * Determine whether the user can attach permission.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function attachPermission(User $user)
    {
        return $user->hasPermission('roles.attach.permission');
    }

    /**
     * Determine whether the user can detach permission.
     *
     * @param  \App\User $user
     * @param  \App\Role $role
     * @param  \App\Permission $permission
     * @return mixed
     */
    public function detachPermission(User $user, Role $role, Permission $permission)
    {
        if ($role->permissions()->where('permissions.id', $permission->id)->first()->pivot->permanent) {
            return false;
        }

        return $user->hasPermission('roles.detach.permission');
    }
}
