<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ShoppingCartTableSeeder extends Seeder
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
                DB::table('shopping_cart')->insert([
                    'total_cost' => rand(1, 2000),
                    'created_at' => Date::now(),
                    'updated_at' => Date::now()
                ]);
            }
    }
}
