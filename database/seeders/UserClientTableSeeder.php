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
        $customIds = array(3);
        $shoppingId = 41;
        foreach ($customIds as $id) {
            DB::table('user_client')->insert([
                'shopping_cart_id' => $shoppingId,
                'user_id' => $id,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
        // use ids from 46 to 84
        $ids = range(46, 84);
        $shoppingId = 1;
        foreach ($ids as $id) {
            DB::table('user_client')->insert([
                'shopping_cart_id' => $shoppingId,
                'user_id' => $id,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
            $shoppingId++;
        }
    }
}
