<?php

namespace App;

use App\Events\ReceivedTemperatureRecord;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use ScopeTrait;

    public $fillable = ['value'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $events = [
        'created' => ReceivedTemperatureRecord::class,
    ];
}
