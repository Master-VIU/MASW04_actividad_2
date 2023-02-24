<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user_passwords = [
            'admin' => 'admin',
            'prueba' => '1234'
        ];

        foreach($user_passwords as $user => $password) {
            DB::table('user')->insert([
                'username' => $user,
                'password' => Hash::make($password),
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}
