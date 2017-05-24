<?php

namespace App\Console\Commands;

use App\Events\TemperatureWasLogged;
use App\Temperature;
use Illuminate\Console\Command;

class LogTemperature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:temperature {value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log temperature.';

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
        $temperature = Temperature::create([
            'value' => $this->argument('value')
        ]);

        event(new TemperatureWasLogged($temperature));
    }
}
