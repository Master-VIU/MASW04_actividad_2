<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RepairmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrays = range(0, 10);
        foreach ($arrays as $valor) {
            DB::table('repairment')->insert([
                'description' => Str::random(250),
                'request_date' => Date::now(),
                'repairment_date' => Date::now(),
                'price' => rand(1, 999),
                'staff_id' => 1,
                'client_id' => 1,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}