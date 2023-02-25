<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RatingTableSeeder extends Seeder
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
            DB::table('rating')->insert([
                'rate' => rand(1, 5),
                'opinion' => Str::random(250),
                'date' => Date::now(),
                'user_client_id' => 1,
                'product_id' => 1,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}