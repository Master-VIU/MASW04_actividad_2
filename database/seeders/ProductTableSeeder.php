<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
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
            DB::table('product')->insert([
                'category_id' => 1,
                'name' => Str::random(50),
                'description' => Str::random(250),
                'price' => rand(1, 9999),
                'properties' => Str::random(250),
                'stock' => rand(1, 9999),
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}