<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CardTableSeeder extends Seeder
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
                DB::table('card')->insert([
                    'card_number' => Str::random(50),    
                    'type' => 'credit',
                    'cvv' => rand(1, 999),
                    'expiration_date' => Date::('2000', '01', '01'),
                    'user_client_id' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now()
            ]);
        }
    }
}
