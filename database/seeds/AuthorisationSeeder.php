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
            'level' => 3,
            'permanent' => true
        ]);

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


        $viewPermissionsPermission = Permission::create([
            'name' => 'View permissions',
            'slug' => 'permissions.view',
            'permanent' => true
        ]);

        $createPermissionsPermission = Permission::create([
            'name' => 'Create permissions',
            'slug' => 'permissions.create',
            'permanent' => true
        ]);

        $updatePermissionsPermission = Permission::create([
            'name' => 'Update permissions',
            'slug' => 'permissions.update',
            'permanent' => true
        ]);

        $deletePermissionsPermission = Permission::create([
            'name' => 'Delete permissions',
            'slug' => 'permissions.delete',
            'permanent' => true
        ]);


        $adminRole->attachPermission($viewPermissionsPermission, ['permanent' => true]);
        $adminRole->attachPermission($createPermissionsPermission, ['permanent' => true]);
        $adminRole->attachPermission($updatePermissionsPermission, ['permanent' => true]);
        $adminRole->attachPermission($deletePermissionsPermission, ['permanent' => true]);

        $viewRolesPermission = Permission::create([
            'name' => 'View roles',
            'slug' => 'roles.view',
            'permanent' => true
        ]);

        $createRolesPermission = Permission::create([
            'name' => 'Create roles',
            'slug' => 'roles.create',
            'permanent' => true
        ]);

        $updateRolesPermission = Permission::create([
            'name' => 'Update roles',
            'slug' => 'roles.update',
            'permanent' => true
        ]);

        $deleteRolesPermission = Permission::create([
            'name' => 'Delete roles',
            'slug' => 'roles.delete',
            'permanent' => true
        ]);

        $attachPermissionRolePermission = Permission::create([
            'name' => 'Attach permission to role',
            'slug' => 'roles.attach.permission',
            'permanent' => true
        ]);

        $detachPermissionRolePermission = Permission::create([
            'name' => 'Detach permission from role',
            'slug' => 'roles.detach.permission',
            'permanent' => true
        ]);

        $adminRole->attachPermission($viewRolesPermission, ['permanent' => true]);
        $adminRole->attachPermission($createRolesPermission, ['permanent' => true]);
        $adminRole->attachPermission($updateRolesPermission, ['permanent' => true]);
        $adminRole->attachPermission($deleteRolesPermission, ['permanent' => true]);
        $adminRole->attachPermission($attachPermissionRolePermission, ['permanent' => true]);
        $adminRole->attachPermission($detachPermissionRolePermission, ['permanent' => true]);

        $viewUsersPermission = Permission::create([
            'name' => 'View users',
            'slug' => 'users.view',
            'permanent' => true
        ]);

        $createUsersPermission = Permission::create([
            'name' => 'Create users',
            'slug' => 'users.create',
            'permanent' => true
        ]);

        $updateUsersPermission = Permission::create([
            'name' => 'Update users',
            'slug' => 'users.update',
            'permanent' => true
        ]);

        $deleteUsersPermission = Permission::create([
            'name' => 'Delete users',
            'slug' => 'users.delete',
            'permanent' => true
        ]);

        $attachPermissionUsersPermission = Permission::create([
            'name' => 'Attach permission to user',
            'slug' => 'users.attach.permission',
            'permanent' => true
        ]);

        $detachPermissionUsersPermission = Permission::create([
            'name' => 'Detach permission from user',
            'slug' => 'users.detach.permission',
            'permanent' => true
        ]);

        $attachRoleUsersPermission = Permission::create([
            'name' => 'Attach role to user',
            'slug' => 'users.attach.role',
            'permanent' => true
        ]);

        $detachRoleUsersPermission = Permission::create([
            'name' => 'Detach role from user',
            'slug' => 'users.detach.role',
            'permanent' => true
        ]);

        $adminRole->attachPermission($viewUsersPermission, ['permanent' => true]);
        $adminRole->attachPermission($createUsersPermission, ['permanent' => true]);
        $adminRole->attachPermission($updateUsersPermission, ['permanent' => true]);
        $adminRole->attachPermission($deleteUsersPermission, ['permanent' => true]);
        $adminRole->attachPermission($attachPermissionUsersPermission, ['permanent' => true]);
        $adminRole->attachPermission($detachPermissionUsersPermission, ['permanent' => true]);
        $adminRole->attachPermission($attachRoleUsersPermission, ['permanent' => true]);
        $adminRole->attachPermission($detachRoleUsersPermission, ['permanent' => true]);

    }
}
