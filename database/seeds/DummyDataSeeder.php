<?php

use App\Humidity;
use App\Temperature;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $points = 60*24;
        factory(Humidity::class, $points)->create();
        factory(Temperature::class, $points)->create();
//        factory(Temperature::class, $points)->create([
//            'value' => '10',
//        ]);
    }
}
