<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use Illuminate\Console\Command;

class RegisterAdministratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:administrator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register administrator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->line('Please complete the prompts to register an administrator user.');

        $name = $this->ask('Name');
        $email = $this->ask('Email');
        $password = $this->secret('Password (hidden input)');
        $password_confirm = $this->secret('Confirm Password (hidden input)');

        if ($password != $password_confirm) {
            $this->error('Passwords did not match!');
            return;
        }

        if (!$this->confirm("Do you wish to create an administrator with the name \"$name\" and email address \"$email\"?")) {
            return;
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::register(['name' => $name, 'email' => $email, 'password' => $password]);
        }

        $adminRole = Role::where('slug', 'admin')->firstOrFail();

        $user->attachRole($adminRole);
    }
}
