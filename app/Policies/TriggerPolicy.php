<?php

namespace App\Policies;

use App\User;
use App\Trigger;
use Illuminate\Auth\Access\HandlesAuthorization;

class TriggerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the trigger.
     *
     * @param User $user
     * @param Trigger $trigger
     * @return mixed
     */
    public function view(User $user, Trigger $trigger = null)
    {
        $isAttached = $trigger ? $trigger->users()->where('users.id', $user->id)->count() : false;

        return $user->hasPermission('triggers.view') || $user->id === $trigger->creator_id || $isAttached;
    }

    /**
     * Determine whether the user can create triggers.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('triggers.create');
    }

    /**
     * Determine whether the user can update the trigger.
     *
     * @param User $user
     * @param Trigger $trigger
     * @return mixed
     */
    public function update(User $user, Trigger $trigger)
    {
        return $user->id === $trigger->creator_id || $user->hasPermission('triggers.update');

    }

    /**
     * Determine whether the user can delete the trigger.
     *
     * @param User $user
     * @param Trigger $trigger
     * @return mixed
     */
    public function delete(User $user, Trigger $trigger)
    {
        return $user->id === $trigger->creator_id || $user->hasPermission('triggers.delete');
    }

    /**
     * Determine whether the user can attach trigger.
     *
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function attachUser(User $user, User $model)
    {
        return $user->id === $model->id || $user->hasPermission('triggers.attach.user');
    }

    /**
     * Determine whether the user can detach trigger.
     *
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function detachUser(User $user, User $model)
    {
        return $user->id === $model->id || $user->hasPermission('triggers.detach.user');
    }
}
