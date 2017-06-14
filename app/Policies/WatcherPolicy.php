<?php

namespace App\Policies;

use App\User;
use App\Watcher;
use Illuminate\Auth\Access\HandlesAuthorization;

class WatcherPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the watcher.
     *
     * @param  \App\User  $user
     * @param  \App\Watcher  $watcher
     * @return mixed
     */
    public function view(User $user, Watcher $watcher)
    {
        //
    }

    /**
     * Determine whether the user can create watchers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the watcher.
     *
     * @param  \App\User  $user
     * @param  \App\Watcher  $watcher
     * @return mixed
     */
    public function update(User $user, Watcher $watcher)
    {
        //
    }

    /**
     * Determine whether the user can delete the watcher.
     *
     * @param  \App\User  $user
     * @param  \App\Watcher  $watcher
     * @return mixed
     */
    public function delete(User $user, Watcher $watcher)
    {
        //
    }
}
