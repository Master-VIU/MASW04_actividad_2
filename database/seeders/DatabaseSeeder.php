<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            ShoppingCartTableSeeder::class,
            UserClientTableSeeder::class,
            UserStaffTableSeeder::class,
            PersonTableSeeder::class,
            CategoryTableSeeder::class,
            ProductTableSeeder::class,
            AddressTableSeeder::class,
            CardTableSeeder::class,
            // RepairmentTableSeeder::class,
            RatingTableSeeder::class,
            ShoppingCartProductTableSeeder::class,
            ClientAddressTableSeeder::class,
            OrderTableSeeder::class,
            ProductImageTableSeeder::class,
        ]);
    }
}
