<?php

namespace App;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    use SluggableTrait;

    public function __construct(array $attributes = [])
    {
        $this->separator = config('roles.separator');

        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'model'];

    /**
     * Permission belongs to many roles.
     *
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Permission belongs to many users.
     *
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
