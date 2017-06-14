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
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admintest')
        ]);

        $role = Role::where('slug', 'admin')->firstOrFail();

        $user->attachRole($role);
    }
}
