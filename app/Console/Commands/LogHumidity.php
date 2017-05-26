<?php

namespace App\Console\Commands;

use App\Events\HumidityWasLogged;
use App\Humidity;
use Illuminate\Console\Command;

class LogHumidity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:humidity {value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log humidity.';

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
            'value' => $this->argument('value')
        ]);

        event(new HumidityWasLogged($humidity));
    }
}
