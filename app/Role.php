<?php

namespace App;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
    protected $fillable = ['name', 'slug', 'description', 'level'];

    /**
     * Role belongs to many permissions.
     *
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    /**
     * Role belongs to many users.
     *
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Attach permission to a role.
     *
     * @param int|Permission $permission
     * @return int|bool
     */
    public function attachPermission($permission)
    {
        return (!$this->permissions()->get()->contains($permission)) ? $this->permissions()->attach($permission) : true;
    }

    /**
     * Detach permission from a role.
     *
     * @param int|Permission $permission
     * @return int
     */
    public function detachPermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    /**
     * Detach all permissions.
     *
     * @return int
     */
    public function detachAllPermissions()
    {
        return $this->permissions()->detach();
    }

    /**
     * Sync permissions for a role.
     *
     * @param array|Permission[]|Collection $permissions
     * @return array
     */
    public function syncPermissions($permissions)
    {
        return $this->permissions()->sync($permissions);
    }
}
