<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
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
                    'card_number' => rand(11111, 99999).rand(11111, 99999).rand(11111, 99999).rand(11111, 99999),
                    'type' => 'credit',
                    'cvv' => rand(111, 999),
                    'expiration_date' => Carbon::createFromDate(2023)->addYears(rand(1,5))->format('Y-m-d'),
                    'user_client_id' => 1,
                    'created_at' => Date::now(),
                    'updated_at' => Date::now()
            ]);
        }
    }
}
