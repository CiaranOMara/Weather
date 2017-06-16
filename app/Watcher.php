<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class Watcher extends Model
{

    public static $conditions = ['High' => 'Greater than', 'Low' => 'Less than'];
    public static $models = ['Humidity' => 'Humidity', 'Temperature' => 'Temperature'];

    protected $fillable = ['description', 'condition', 'trigger_value', 'observing', 'creator_id'];

    /**
     * Watcher belongs to many users.
     *
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Watcher belongs to creator.
     *
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function observeSignal(Model $model)
    {

        $previous = $model->newQuery()->where('id', '<', $model->id)->orderBy('id', 'desc')->first();

        // check if alert should be raised.
        if ($this->triggered($model->value) && (!$previous || !$this->triggered($previous->value))) { //Note doesn't rigger if new and current.

            $this->raiseAlert($model);

            return;
        }

        // check if alert should be lowered.
        if (!$this->triggered($model->value) && $previous && $this->triggered($previous->value)) {

            $this->lowerAlert($model);

            return;
        }
    }

    public function triggered($value)
    {
        switch ($this->condition) { // TODO: create classes and implement polymorphism.
            case 'High':
                if ($value > $this->trigger_value) {
                    return true;
                }
                break;

            case 'Low':
                if ($value < $this->trigger_value) {
                    return true;
                }
                break;
        }

        return false;
    }

    private function alert(Notification $notification)
    {
        foreach ($this->users as $user) {
            $user->notify($notification);
        }
    }

    public function raiseAlert(Model $model)
    {
        $class = 'App\\Notifications\\' . $this->condition . $this->observing;

        $notification = new $class($this, $model); //Note: should throw exception if class is not found.

        $this->alert($notification);
    }

    public function lowerAlert(Model $model)
    {
        $class = 'App\\Notifications\\' . $this->condition . $this->observing . 'Resolved';

        $notification = new $class($this, $model); //Note: should throw exception if class is not found.

        $this->alert($notification);

        //TODO: mark previous notification as read.
    }

}


