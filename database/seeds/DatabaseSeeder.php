<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AuthorisationSeeder::class); // php artisan db:seed --class=AuthorisationSeeder
        $this->call(WatcherAuthorisationSeeder::class); // php artisan db:seed --class=WatcherAuthorisationSeeder
        $this->call(UsersTableSeeder::class);
    }
}
