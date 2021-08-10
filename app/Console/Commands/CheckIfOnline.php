<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckIfOnline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:online';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make users online of offline';

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
     * @return int
     */
    public function handle()
    {
        User::where('last_seen','<',now()->subMinutes(2))->update(['is_online'=>0]);
        User::where('last_seen','>=',now()->subMinute())->update(['is_online'=>1]);

        return 0;
    }
}
