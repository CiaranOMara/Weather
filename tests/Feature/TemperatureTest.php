<?php

namespace Tests\Feature;

use App\Events\ReceivedTemperatureRecord;
use App\Temperature;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TemperatureTest extends TestCase
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
        $temperature = factory(Temperature::class, 10)->create();

        $low = factory(Temperature::class, 1)->states('low')->make();

        $high = factory(Temperature::class, 1)->states('high')->make();
    }

    public function testLog()
    {

        Event::fake();

        $value = 12349;

        $exitCode = Artisan::call('record:temperature', [
            'value' => $value
        ]);

        Event::assertDispatched(ReceivedTemperatureRecord::class, function ($e) use ($value) {
            return $e->temperature->value === $value;
        });

        $this->assertDatabaseHas('temperatures', [
            'value' => $value
        ]);
    }
}