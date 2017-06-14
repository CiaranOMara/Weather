<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class Watcher extends Model
{

    public static $conditions = ['High' => 'Greater than', 'Low' => 'Less than'];
    public static $models = ['Humidity' => 'Humidity', 'Temperature' => 'Temperature'];

    protected $fillable = ['description', 'condition', 'trigger_value', 'observing', 'created_by'];

    /**
     * Role belongs to many users.
     *
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }



}


