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
        'password', 'remember_token', 'verification_token',
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
    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (User $user) {
            $user->verification_token = Str::random(60);;
        });
    }

    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->verification_token = null;

        $this->save();
    }

}
