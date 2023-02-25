<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserClientTableSeeder extends Seeder
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
            DB::table('user_client')->insert([
                'shopping_cart_id' => 1,//rand(1, 14)
                'user_id' => 1, //rand(1, 14)
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}