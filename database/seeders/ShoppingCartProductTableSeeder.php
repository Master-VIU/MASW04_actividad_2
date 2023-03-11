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
        $productIds = array(1, 2, 3);
        foreach($productIds as $productId) {
            $quantity = rand(1, 100);
            $price = DB::table('product')->where('product_id', $productId)->pluck('price')[0];
            $total_cost = DB::table('shopping_cart')->where('shopping_cart_id', 1)->pluck('total_cost')[0];
            DB::table('shopping_cart_product')->insert([
                'shopping_cart_id' => 1,
                'product_id' => $productId,
                'quantity' => $quantity,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
            DB::table('shopping_cart')->where('shopping_cart_id', 1)->update([
                'total_cost' => $total_cost + ($quantity * $price)
            ]);
        }
    }
}
