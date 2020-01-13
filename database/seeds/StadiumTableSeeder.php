<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StadiumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tbl_stadium')->insert([
            'stadium_name' => 'ເດີ່ນພະຍາຫໍານ້ອຍ',
            'stadium_type' => 'ເດີ່ນໃນຮົ່ມ',
            'stadium_capacity' => 11,
            'stadium_fee' => 150000,
        ]);
        DB::table('tbl_stadium')->insert([
            'stadium_name' => 'ເດີ່ນເລີຈຸກກຼູ້',
            'stadium_type' => 'ເດີ່ນການແຈ້ງ',
            'stadium_capacity' => 11,
            'stadium_fee' => 100000,
        ]);
        DB::table('tbl_stadium')->insert([
            'stadium_name' => 'ເດີ່ນອ້າຍໂຕ',
            'stadium_type' => 'ເດີ່ນໃນຮົ່ມ',
            'stadium_capacity' => 7,
            'stadium_fee' => 100000,
        ]);
        DB::table('tbl_stadium')->insert([
            'stadium_name' => 'ເດີ່ນບັກອາຕີ້',
            'stadium_type' => 'ເດີ່ນການແຈ້ງ',
            'stadium_capacity' => 7,
            'stadium_fee' => 75000,
        ]);
    }
}
