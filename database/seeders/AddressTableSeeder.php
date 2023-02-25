<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrays = range(0,10);
            foreach ($arrays as $valor) {
                DB::table('address')->insert([
                    'street' => Str::random(200),
                    'street_number' => rand(1, 999),
                    'city' => Str::random(100),
                    'postal_code' => rand(1, 999999),
                    'created_at' => Date::now(),
                    'updated_at' => Date::now()
            ]);
        }
    }
}
