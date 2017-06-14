<?php

namespace App\Console\Commands;

use App\Events\ReceivedHumidityRecord;
use App\Events\ReceivedTemperatureRecord;
use App\Humidity;
use App\Temperature;
use Illuminate\Console\Command;

class RecordWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'record:weather {humidity} {temperature}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record humidity and temperature';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $humidity = Humidity::create([
            'value' => $this->argument('humidity')
        ]);

        $temperature = Temperature::create([
            'value' => $this->argument('temperature')
        ]);

    }
}
