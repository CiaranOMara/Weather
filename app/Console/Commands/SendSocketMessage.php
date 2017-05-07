<?php

namespace App\Console\Commands;

use App\Events\SendMessageEvent;
use Illuminate\Console\Command;

class SendSocketMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:message {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send socket message';

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
        broadcast(new SendMessageEvent($this->argument('message')));
    }
}
