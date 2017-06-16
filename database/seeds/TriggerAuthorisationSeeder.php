<?php

use App\Permission;
use App\Role;
use App\User;
use App\Trigger;
use Illuminate\Database\Seeder;

class TriggerAuthorisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viewTriggerPermission = Permission::create([
            'name' => 'View triggers',
            'slug' => 'triggers.view',
            'model' => Trigger::class,
            'permanent' => true
        ]);

        $createTriggerPermission = Permission::create([
            'name' => 'Create triggers',
            'slug' => 'triggers.create',
            'model' => Trigger::class,
            'permanent' => true
        ]);

        $updateTriggerPermission = Permission::create([
            'name' => 'Update triggers',
            'slug' => 'triggers.update',
            'model' => Trigger::class,
            'permanent' => true
        ]);

        $deleteTriggerPermission = Permission::create([
            'name' => 'Delete triggers',
            'slug' => 'triggers.delete',
            'model' => Trigger::class,
            'permanent' => true
        ]);

        $attachTriggerToUserPermission = Permission::create([
            'name' => 'Attach user to trigger',
            'slug' => 'triggers.attach.user',
            'model' => Trigger::class,
            'permanent' => true
        ]);

        $detachTriggerToUserPermission = Permission::create([
            'name' => 'Detach user from trigger',
            'slug' => 'triggers.detach.user',
            'model' => Trigger::class,
            'permanent' => true
        ]);

        $adminRole = Role::where('slug', 'admin')->firstOrFail();

        $adminRole->attachPermission($viewTriggerPermission, ['permanent' => true]);
        $adminRole->attachPermission($createTriggerPermission, ['permanent' => true]);
        $adminRole->attachPermission($updateTriggerPermission, ['permanent' => true]);
        $adminRole->attachPermission($deleteTriggerPermission, ['permanent' => true]);
        $adminRole->attachPermission($attachTriggerToUserPermission, ['permanent' => true]);
        $adminRole->attachPermission($detachTriggerToUserPermission, ['permanent' => true]);


        $moderatorRole = Role::where('slug', 'moderator')->firstOrFail();

        $moderatorRole->attachPermission($viewTriggerPermission);
        $moderatorRole->attachPermission($createTriggerPermission);
//        $moderatorRole->attachPermission($attachTriggerToUserPermission);


    }
}
