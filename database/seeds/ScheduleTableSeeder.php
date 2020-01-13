<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tbl_schedule')->insert([
            'time' => '8:00 - 10:00'
        ]);
        DB::table('tbl_schedule')->insert([
            'time' => '10:00 - 12:00'
        ]);
        DB::table('tbl_schedule')->insert([
            'time' => '12:00 - 14:00'
        ]);
        DB::table('tbl_schedule')->insert([
            'time' => '14:00 - 16:00'
        ]);
        DB::table('tbl_schedule')->insert([
            'time' => '16:00 - 18:00'
        ]);
        DB::table('tbl_schedule')->insert([
            'time' => '18:00 - 20:00'
        ]);
    }
}
