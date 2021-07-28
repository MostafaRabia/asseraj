<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CountTimeInRooms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rooms:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count time in open rooms';

    /**
     * Create a new command instance.
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
        DB::table('rooms')->where('status', 'open')->lockForUpdate()->increment('time', 1);

        return 0;
    }
}
