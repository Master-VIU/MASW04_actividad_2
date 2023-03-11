<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserStaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_staff')->insert([
            'role' => 'technician',
            'user_id' => 1,
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
        DB::table('user_staff')->insert([
            'role' => 'consultant',
            'user_id' => 2,
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
        DB::table('user_staff')->insert([
            'role' => 'technician',
            'user_id' => 4,
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);
        // use ids from 5 to 45
        $ids = range(5, 45);
        foreach ($ids as $id) {
            DB::table('user_staff')->insert([
                'role' => $this->getRandomRole(),
                'user_id' => $id,
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }

    private function getRandomRole(): string
    {
        $roles = array('technician', 'consultant');
        $roleIndex = rand(0, 1);
        return $roles[$roleIndex];
    }
}
