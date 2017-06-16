<?php

namespace App\Policies;

use App\User;
use App\Watcher;
use Illuminate\Auth\Access\HandlesAuthorization;

class WatcherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the watcher.
     *
     * @param User $user
     * @param Watcher $watcher
     * @return mixed
     */
    public function view(User $user, Watcher $watcher = null)
    {
        $isAttached = $watcher ? $watcher->users()->where('users.id', $user->id)->count() : false;

        return $user->hasPermission('watchers.view') || $user->id === $watcher->creator || $isAttached;
    }

    /**
     * Determine whether the user can create watchers.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('watchers.create');
    }

    /**
     * Determine whether the user can update the watcher.
     *
     * @param User $user
     * @param Watcher $watcher
     * @return mixed
     */
    public function update(User $user, Watcher $watcher)
    {
        return $user->id === $watcher->creator || $user->hasPermission('watchers.update');

    }

    /**
     * Determine whether the user can delete the watcher.
     *
     * @param User $user
     * @param Watcher $watcher
     * @return mixed
     */
    public function delete(User $user, Watcher $watcher)
    {
        return $user->id === $watcher->creator || $user->hasPermission('watchers.delete');
    }

    /**
     * Determine whether the user can attach watcher.
     *
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function attachUser(User $user, User $model)
    {
        return $user->id === $model->id || $user->hasPermission('watchers.attach.user');
    }

    /**
     * Determine whether the user can detach watcher.
     *
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function detachUser(User $user, User $model)
    {
        return $user->id === $model->id || $user->hasPermission('watchers.detach.user');
    }
}
