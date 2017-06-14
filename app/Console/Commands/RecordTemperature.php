<?php

namespace App\Console\Commands;

use App\Events\ReceivedTemperatureRecord;
use App\Temperature;
use Illuminate\Console\Command;

class RecordTemperature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'record:temperature {value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record temperature.';

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
    }
}
