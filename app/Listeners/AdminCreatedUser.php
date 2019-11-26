<?php

namespace App\Listeners;

use App\Events\AdminCreatedUser as EventAdminCreatedUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Log;

class AdminCreatedUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(EventAdminCreatedUser $event)
    {
        Log::info("Admin created user:", ['admin' => $event->admin->email, 'created user' => $event->user->toArray()]);

        if ($event->user instanceof MustVerifyEmail && !$event->user->hasVerifiedEmail()) {
            $event->user->sendEmailVerificationNotification();
        }
    }
}
