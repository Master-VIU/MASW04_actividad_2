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
        $shoppingCarts = range(0, 41);
        foreach ($shoppingCarts as $shoppingCart) {
            DB::table('shopping_cart')->insert([
                'total_cost' => 0,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}
