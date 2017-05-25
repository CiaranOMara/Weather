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
        factory(Humidity::class, 1000)->create();
        factory(Temperature::class, 1000)->create();
    }
}
