<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ShoppingCartProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('shopping_cart_product')->insert([
            'shopping_cart_id' => 1,
            'product_id' => 1,
            'quantity' => rand(1, 100),
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
    }
}