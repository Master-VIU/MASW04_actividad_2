<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total_cost = DB::table('shopping_cart')->where('shopping_cart_id', 1)->pluck('total_cost')[0];
        DB::table('order')->insert([
            'price' => $total_cost,
            'order_date' => Date::now(),
            'shipping_date' => Date::now(),
            'location' => 'In the way',
            'card_id' => 1,
            'address_id' => 1,
            'client_id' => 1,
            'shopping_cart_id' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
    }
}
