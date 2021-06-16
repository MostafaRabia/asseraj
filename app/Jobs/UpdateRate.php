<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateRate implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $column;
    protected $id;

    public function __construct($column, $id)
    {
        $this->column = $column;
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $get_all_rates = DB::table('rooms')->where($this->column, $this->id)->selectRaw('COUNT(*) as count, SUM(teacher_rate) as sum')->first();
        $rate = number_format($get_all_rates->sum / $get_all_rates->count, 2);
        User::where('id', $this->id)->update(['rate' => $rate]);
    }
}
