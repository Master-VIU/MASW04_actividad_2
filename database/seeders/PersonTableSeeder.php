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
        $arrays = range(0,10);
            foreach ($arrays as $valor) {
              DB::table('person')->insert([	            
                  'dni' => Str::random(12),
                  'name' => Str::random(50),
                  'surname' => Str::random(50),
                  'email' => Str::random(50).'@email.com',
                  'telephone' => Str::random(50),
                  'user_id' => 1,
                  'created_at' => Date::now(),
                  'updated_at' => Date::now()
              ]);
        }
    }
}
