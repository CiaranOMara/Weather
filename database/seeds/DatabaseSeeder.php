<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AuthorisationSeeder::class); // php artisan db:seed --class=AuthorisationSeeder
        $this->call(TriggerAuthorisationSeeder::class); // php artisan db:seed --class=WatcherAuthorisationSeeder
        $this->call(UsersTableSeeder::class);
    }
}
