<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the databaseNotification.
     *
     * @param  \App\User $user
     * @param  \Illuminate\Notifications\DatabaseNotification $databaseNotification
     * @return mixed
     */
    public function view(User $user, DatabaseNotification $databaseNotification)
    {
        //
    }

    /**
     * Determine whether the user can create databaseNotifications.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the databaseNotification.
     *
     * @param  \App\User $user
     * @param  \Illuminate\Notifications\DatabaseNotification $databaseNotification
     * @return mixed
     */
    public function update(User $user, DatabaseNotification $databaseNotification)
    {
        return $databaseNotification->notifiable_type === 'App\User' && $databaseNotification->notifiable_id === $user->id;
    }

    /**
     * Determine whether the user can delete the databaseNotification.
     *
     * @param  \App\User $user
     * @param  \Illuminate\Notifications\DatabaseNotification $databaseNotification
     * @return mixed
     */
    public function delete(User $user, DatabaseNotification $databaseNotification)
    {
        //
    }
}
