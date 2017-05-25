<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class QueryAM2315 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'query:am2315';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Query AM2315 sensor';

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
        $humidity = null;
        $temperature = null;

        $path = app_path('Sensors/AM2315.py');

        // Call python script.
        $mystring = system('python3 '.$path, $retval);

//        dd([
//          '$mystring'=>$mystring,
//          '$retval'=>$retval,
//        ]);

        $weather = explode(' ', $mystring);
//        dd($weather);

        $humidity = $weather[0];
        $temperature = $weather[1];

        if ($humidity && $temperature) {
            $exitCode = Artisan::call('log:weather', [
                'humidity' => $humidity, 'temperature' => $temperature
            ]);
        }
    }
}
