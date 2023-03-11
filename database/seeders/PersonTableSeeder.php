<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peopleIds = range(1, 84);
        foreach ($peopleIds as $personId) {
            $username = DB::table('user')
                ->where('user_id', $personId)
                ->pluck('username')[0];
            DB::table('person')->insert([
                'dni' => rand(10000000, 99999999).Str::random(1),
                'name' => $username,
                'surname' => 'surname',
                'email' => $username.'@email.com',
                'telephone' => rand(600000000, 999999999),
                'user_id' => $personId,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}
