<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ClientAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('client_address')->insert([
            'client_id' => 1,
            'address_id' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
    }
}