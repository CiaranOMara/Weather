<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function view(User $user, User $model = null)
    {
        return ($model && $user->id === $model->id) || $user->hasPermission('users.view');
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('users.create');
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->id === $model->id || $user->hasPermission('users.update');
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->hasPermission('users.delete');
    }

    /**
     * Determine whether the user can attach permission.
     *
     * @param  \App\User $user
     * @param  \App\User $user
     * @return mixed
     */
    public function attachPermission(User $user)
    {
        return $user->hasPermission('users.attach.permission');
    }

    /**
     * Determine whether the user can detach permission.
     *
     * @param  \App\User $user
     * @param  \App\User $user
     * @return mixed
     */
    public function detachPermission(User $user)
    {
        return $user->hasPermission('users.detach.permission');
    }

    /**
     * Determine whether the user can attach role.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function attachRole(User $user)
    {
        return $user->hasPermission('users.attach.role');
    }

    /**
     * Determine whether the user can detach role.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function detachRole(User $user)
    {
        return $user->hasPermission('users.detach.role');
    }

}
