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
            CategoryTableSeeder::class,
            ShoppingCartTableSeeder::class,
            UserTableSeeder::class,
            PersonTableSeeder::class,
            AddressTableSeeder::class,
            UserClientTableSeeder::class,
            CardTableSeeder::class,
            ProductTableSeeder::class,
            RatingTableSeeder::class,
            ClientAddressTableSeeder::class,
            ProductImageTableSeeder::class,
            OrderTableSeeder::class,
            UserStaffTableSeeder::class,
            RepairmentTableSeeder::class,
            ShoppingCartProductTableSeeder::class
        ]);
    }
}