<?php

namespace App;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    use Sluggable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->separator = config('roles.separator');
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
