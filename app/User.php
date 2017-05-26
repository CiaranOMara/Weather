<?php

namespace App;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return array
     */
    public function receivesBroadcastNotificationsOn()
    {
        return [
            new PrivateChannel('users.' . $this->id),
        ];
    }
}
