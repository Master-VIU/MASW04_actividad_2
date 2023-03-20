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
        $products = array(
            1 => array(
                'category_id' => 2,
                'name' => 'Keychron K6',
                'description' => 'A 60% keyboard for improve your productivity',
                'price' => 65.5,
                'properties' => '60% keyboard, Hot swappable switches, White keys',
                'stock' => 134
            ),
            2 => array(
                'category_id' => 2,
                'name' => 'Keychron K7',
                'description' => 'A 70% keyboard for improve your productivity',
                'price' => 75.5,
                'properties' => '70% keyboard, Hot swappable switches, White keys',
                'stock' => 144
            ),
            3 => array(
                'category_id' => 2,
                'name' => 'Keychron K8',
                'description' => 'A 80% keyboard for improve your productivity',
                'price' => 90.3,
                'properties' => '80% keyboard, Hot swappable switches, White keys',
                'stock' => 13
            ),
            4 => array(
                'category_id' => 2,
                'name' => 'Keychron K9',
                'description' => 'A 90% keyboard for improve your productivity',
                'price' => 123.4,
                'properties' => '90% keyboard, Hot swappable switches, White keys',
                'stock' => 114
            ),
            5 => array(
                'category_id' => 2,
                'name' => 'Keychron K10',
                'description' => 'A 100% keyboard for improve your productivity',
                'price' => 150,
                'properties' => '100% keyboard, Hot swappable switches, White keys',
                'stock' => 56
            ),
        );
        foreach ($products as $id => $properties) {
            DB::table('product')->insert([
                'category_id' => $properties['category_id'],
                'name' => $properties['name'],
                'description' => $properties['description'],
                'price' => $properties['price'],
                'properties' => $properties['properties'],
                'stock' => $properties['stock'],
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}
