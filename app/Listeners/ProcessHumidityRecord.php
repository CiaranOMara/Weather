<?php

namespace App\Listeners;

use App\Events\ReceivedHumidityRecord;
use App\Notifications\HighHumidity;
use App\Notifications\LowHumidity;
use App\Watcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessHumidityRecord
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
     * @param  ReceivedHumidityRecord $event
     * @return void
     */
    public function handle(ReceivedHumidityRecord $event)
    {
        $event->humidity->signal();
    }
}
