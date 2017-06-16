<?php

namespace App\Console\Commands;

use App\Events\ReceivedHumidityRecord;
use App\Humidity;
use Illuminate\Console\Command;

class RecordHumidity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'record:humidity {value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record humidity.';

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
    }
}
