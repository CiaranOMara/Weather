<?php

namespace Tests\Feature;

use App\Events\ReceivedHumidityRecord;
use App\Humidity;
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

        Event::fake();

        $value = 12349;

        $exitCode = Artisan::call('record:humidity', [
            'value' => $value
        ]);

        Event::assertDispatched(ReceivedHumidityRecord::class, function ($e) use ($value) {
            return $e->humidity->value === $value;
        });

        $this->assertDatabaseHas('humidities', [
            'value' => $value
        ]);


    }
}
