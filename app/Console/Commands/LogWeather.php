<?php

namespace App\Console\Commands;

use App\Events\HumidityWasLogged;
use App\Events\TemperatureWasLogged;
use App\Humidity;
use App\Temperature;
use Illuminate\Console\Command;

class LogWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:weather {humidity} {temperature}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log humidity and temperature';

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

        event(new HumidityWasLogged($humidity));

        $temperature = Temperature::create([
            'value' => $this->argument('temperature')
        ]);

        event(new TemperatureWasLogged($temperature));

    }
}
