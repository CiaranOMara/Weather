<?php

use App\Permission;
use App\Role;
use App\User;
use App\Watcher;
use Illuminate\Database\Seeder;

class WatcherAuthorisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viewWatcherPermission = Permission::create([
            'name' => 'View watchers',
            'slug' => 'watchers.view',
            'model' => Watcher::class,
            'permanent' => true
        ]);

        $createWatcherPermission = Permission::create([
            'name' => 'Create watchers',
            'slug' => 'watchers.create',
            'model' => Watcher::class,
            'permanent' => true
        ]);

        $updateWatcherPermission = Permission::create([
            'name' => 'Update watchers',
            'slug' => 'watchers.update',
            'model' => Watcher::class,
            'permanent' => true
        ]);

        $deleteWatcherPermission = Permission::create([
            'name' => 'Delete watchers',
            'slug' => 'watchers.delete',
            'model' => Watcher::class,
            'permanent' => true
        ]);

        $attachWatcherToUserPermission = Permission::create([
            'name' => 'Attach user to watcher',
            'slug' => 'watchers.attach.user',
            'model' => Watcher::class,
            'permanent' => true
        ]);

        $detachWatcherToUserPermission = Permission::create([
            'name' => 'Detach user from watcher',
            'slug' => 'watchers.detach.user',
            'model' => Watcher::class,
            'permanent' => true
        ]);

        $adminRole = Role::where('slug', 'admin')->firstOrFail();

        $adminRole->attachPermission($viewWatcherPermission, ['permanent' => true]);
        $adminRole->attachPermission($createWatcherPermission, ['permanent' => true]);
        $adminRole->attachPermission($updateWatcherPermission, ['permanent' => true]);
        $adminRole->attachPermission($deleteWatcherPermission, ['permanent' => true]);
        $adminRole->attachPermission($attachWatcherToUserPermission, ['permanent' => true]);
        $adminRole->attachPermission($detachWatcherToUserPermission, ['permanent' => true]);


        $moderatorRole = Role::where('slug', 'moderator')->firstOrFail();

        $moderatorRole->attachPermission($viewWatcherPermission);
        $moderatorRole->attachPermission($createWatcherPermission);
//        $moderatorRole->attachPermission($attachWatcherToUserPermission);


    }
}
