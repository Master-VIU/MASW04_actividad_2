<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            'Keyboard & Mouse' => '',
            'Keyboard' => 'Keyboard & Mouse',
            'Mouse' => 'Keyboard & Mouse',
            'Computer' => '',
            'Laptop' => 'Computer',
            'PC' => 'Computer',
            'Accessories' => ''
        );
        foreach ($categories as $category => $parent) {
            $parent = DB::table('category')
                ->where('name_category', $parent)
                ->pluck('category_id');
            $parentId = (sizeof($parent) > 0) ? $parent[0] : null;
            DB::table('category')->insert([
                'name_category' => $category,
                'parent_category_id' => $parentId,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}
