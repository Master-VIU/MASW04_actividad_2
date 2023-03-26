<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numbers = range(1, 41);
        foreach ($numbers as $number) {
            DB::table('address')->insert([
                'street' => 'Calle Barrio Sesamo',
                'street_number' => $number,
                'city' => 'Madrid',
                'postal_code' => 12345,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}
