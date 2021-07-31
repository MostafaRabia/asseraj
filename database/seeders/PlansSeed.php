<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'minutes' => 60,
            'price' => 70
        ]);

        Plan::create([
            'minutes' => 120,
            'price' => 125
        ]);

        Plan::create([
            'minutes' => 180,
            'price' => 180
        ]);
    }
}
