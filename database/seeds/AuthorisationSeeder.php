<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class AuthorisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Administrator role.

        $adminRole = Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'level' => 3
        ]);

        $createUsersPermission = Permission::create([
            'name' => 'Create users',
            'slug' => 'create.users',
        ]);

        $deleteUsersPermission = Permission::create([
            'name' => 'Delete users',
            'slug' => 'delete.users',
        ]);

        $updateUsersPermission = Permission::create([
            'name' => 'Edit users',
            'slug' => 'edit.users',
        ]);

        $adminRole->attachPermission($createUsersPermission);
        $adminRole->attachPermission($deleteUsersPermission);
        $adminRole->attachPermission($updateUsersPermission);

        // Create Moderator role.
        $moderatorRole = Role::create([
            'name' => 'Moderator',
            'slug' => 'moderator',
            'level' => 2
        ]);

        // Create User role.
        $userRole = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'level' => 1
        ]);

    }
}
