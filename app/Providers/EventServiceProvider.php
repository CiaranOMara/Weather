<?php

namespace App\Providers;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        // Recording Events

        \App\Events\ReceivedHumidityRecord::class => [
            \App\Listeners\ProcessHumidityRecord::class,
        ],

        \App\Events\ReceivedTemperatureRecord::class => [
            \App\Listeners\ProcessTemperatureRecord::class,
        ],

        // Administrative Events

        \App\Events\AdminCreatedUser::class => [
            \App\Listeners\SendVerificationRequestFromAdministrator::class,
        ],

        // Authentication Events

        \Illuminate\Auth\Events\Verified::class => [
            \App\Listeners\LogVerifiedUser::class,
        ],

        \Illuminate\Auth\Events\Registered::class => [
            SendEmailVerificationNotification::class,
            \App\Listeners\LogRegisteredUser::class,
        ],

        \Illuminate\Auth\Events\Attempting::class => [
            \App\Listeners\LogAuthenticationAttempt::class,
        ],

        \Illuminate\Auth\Events\Authenticated::class => [
            \App\Listeners\LogAuthenticated::class,
        ],

        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\LogSuccessfulLogin::class,
        ],

        \Illuminate\Auth\Events\Failed::class => [
            \App\Listeners\LogFailedLogin::class,
        ],

        \Illuminate\Auth\Events\Logout::class => [
            \App\Listeners\LogSuccessfulLogout::class,
        ],

        \Illuminate\Auth\Events\Lockout::class => [
            \App\Listeners\LogLockout::class,
        ],

        \Illuminate\Auth\Events\PasswordReset::class => [
            \App\Listeners\LogPasswordReset::class,
        ],

        // Cache events.

        \Illuminate\Cache\Events\CacheHit::class => [
            \App\Listeners\LogCacheHit::class,
        ],

        \Illuminate\Cache\Events\CacheMissed::class => [
            \App\Listeners\LogCacheMissed::class,
        ],

        \Illuminate\Cache\Events\KeyForgotten::class => [
            \App\Listeners\LogKeyForgotten::class,
        ],

        \Illuminate\Cache\Events\KeyWritten::class => [
            \App\Listeners\LogKeyWritten::class,
        ],


        // Message events.

        \Illuminate\Mail\Events\MessageSending::class => [
            \App\Listeners\LogSentMessage::class,
        ],


        // Notification events.

        \Illuminate\Notifications\Events\NotificationSent::class => [
            \App\Listeners\LogNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
