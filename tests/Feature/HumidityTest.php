<?php

namespace Tests\Feature;

use App\Events\ReceivedHumidityRecord;
use App\Humidity;
use App\Listeners\ProcessHumidityRecord;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HumidityTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    public function testDatabase()
    {
        $humidity = factory(Humidity::class, 10)->create();

        $low = factory(Humidity::class, 1)->states('low')->make();

        $high = factory(Humidity::class, 1)->states('high')->make();
    }

    public function testLog()
    {

//        Event::fake();


        $listener = \Mockery::spy(ProcessHumidityRecord::class);
        app()->instance(ProcessHumidityRecord::class, $listener);

        $value = 12349;

        $exitCode = Artisan::call('record:humidity', [
            'value' => $value
        ]);


        $this->assertDatabaseHas('humidities', [
            'value' => $value
        ]);

        $listener->shouldHaveReceived('handle')->with(\Mockery::on(function($event) use ($value){
            return $event->humidity->value === $value;
        }))->once();

//        Event::assertDispatched(ReceivedHumidityRecord::class, function ($event) use ($value) {
//            return $event->humidity->value === $value;
//        });

    }
}
