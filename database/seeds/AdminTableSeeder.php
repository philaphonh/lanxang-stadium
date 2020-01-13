<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tbl_admin')->insert([
            'admin_username' => 'artydev',
            'admin_first_name' => 'Philaphonh',
            'admin_last_name' => 'Inthavongsa',
            'admin_password' => Hash::make('hackerman'),
        ]);
        DB::table('tbl_admin')->insert([
            'admin_username' => 'toto',
            'admin_first_name' => 'Lorkongphet',
            'admin_last_name' => 'Sotouky',
            'admin_password' => Hash::make('toto'),
        ]);
    }
}
