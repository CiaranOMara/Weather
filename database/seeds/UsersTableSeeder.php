<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admintest')
        ]);

        $adminRole = Role::where('slug', 'admin')->firstOrFail();

        $admin->attachRole($adminRole);

        $moderator = User::create([
            'name' => 'moderator',
            'email' => 'moderator@test.com',
            'password' => bcrypt('moderatortest')
        ]);

        $moderatorRole = Role::where('slug', 'moderator')->firstOrFail();

        $moderator->attachRole($moderatorRole);
    }
}
