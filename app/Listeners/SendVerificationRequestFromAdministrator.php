<?php

namespace App\Listeners;

use App\Events\AdminCreatedUser;
use App\Mail\VerificationRequestFromAdministrator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationRequestFromAdministrator
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
     * @param  AdminCreatedUser $event
     * @return void
     */
    public function handle(AdminCreatedUser $event)
    {
        Mail::to($event->user)->send(new VerificationRequestFromAdministrator($event->user));
    }
}
