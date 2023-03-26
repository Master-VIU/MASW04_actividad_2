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
        $repairments = array(
            1 => array(
                'description' => 'Repared a mouse without cable',
                'request_date' => Date::now(),
                'repairment_date' => Date::now(),
                'price' => 34.5,
                'staff_id' => 1,
                'client_id' => 1
            ),
            2 => array(
                'description' => 'Repared a keyboard without cable',
                'request_date' => Date::now(),
                'repairment_date' => Date::now(),
                'price' => 22.2,
                'staff_id' => 1,
                'client_id' => 1
            ),
        );
        foreach ($repairments as $repairment) {
            DB::table('repairment')->insert([
                'description' => $repairment['description'],
                'request_date' => $repairment['request_date'],
                'repairment_date' => $repairment['repairment_date'],
                'price' => $repairment['price'],
                'staff_id' => $repairment['staff_id'],
                'client_id' => $repairment['client_id'],
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}
