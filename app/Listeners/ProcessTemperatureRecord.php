<?php

namespace App\Listeners;

use App\Events\ReceivedTemperatureRecord;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessTemperatureRecord
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
     * @param  ReceivedTemperatureRecord  $event
     * @return void
     */
    public function handle(ReceivedTemperatureRecord $event)
    {
        $event->temperature->process();
    }
}
