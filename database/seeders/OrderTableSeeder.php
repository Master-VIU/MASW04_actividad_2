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
        $arrays = range(0, 10);
        foreach ($arrays as $valor) {
            DB::table('order')->insert([
                'price' => rand(1, 9999),
                'order_date' => Date::now(),
                'shipping_date' => Date::now(),
                'location' => Str::random(100),
                'card_id' => 1,
                'address_id' => 1,
                'client_id' => 1,
                'shopping_cart_id' => 1,
                'created_at' => Date::now(),
                'updated_at' => Date::now()

            ]);
        }
    }
}