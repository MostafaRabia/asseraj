<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'outer_pages'],
            ['name' => 'teachers'],
            ['name' => 'students'],
            ['name' => 'transfer_money'],
            ['name' => 'contact_us'],
            ['name' => 'permissions'],
        ]);
    }
}
