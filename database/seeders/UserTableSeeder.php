<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
            DB::table('user')->insert([
                'username' => Str::random(50),
                'password' => Hash::make('password'),
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}