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
        $user_passwords = [
            'admin' => 'admin',
            'prueba' => '1234',
            'cliente' => '1234',
            'trabajador' => '1234',
            'armyranhanap' => 'password',
            'slapstick' => 'password',
            'cephalophore' => 'password',
            'mucketymuck' => 'password',
            'ned_paycymar' => 'password',
            'mugwump' => 'password',
            'italomania' => 'password',
            'myevilyips' => 'password',
            'polymania' => 'password',
            'flabbergast' => 'password',
            'stercorate' => 'password',
            'quicksticks' => 'password',
            'penology' => 'password',
            'coptionguru' => 'password',
            'bresnahaliter' => 'password',
            'highfalutin' => 'password',
            'polypharmacy' => 'password',
            'drizzle' => 'password',
            'kozejgadoid' => 'password',
            'yeetsverve' => 'password',
            'squeegee' => 'password',
            'hyperbole' => 'password',
            'anglik1merlon' => 'password',
            'bloviate' => 'password',
            'raciology' => 'password',
            'jubilee' => 'password',
            'montiform' => 'password',
            'doldrums' => 'password',
            'escarole' => 'password',
            'baggi17coot' => 'password',
            'archiloquy' => 'password',
            'murmuration' => 'password',
            'ombrophilous' => 'password',
            'misanthrope' => 'password',
            'kudakvisile' => 'password',
            'orgulous' => 'password',
            'filature' => 'password',
            'ynionhooey' => 'password',
            'lulliloo' => 'password',
            'flyspeck' => 'password',
            'tumefymur35' => 'password',
            'sambur' => 'password',
            'cofflemauk' => 'password',
            'sully' => 'password',
            'underbridge' => 'password',
            'yowza' => 'password',
            'asteism' => 'password',
            'svengali' => 'password',
            'killock' => 'password',
            'natiform' => 'password',
            'porphyrous' => 'password',
            'usurp' => 'password',
            'denouement' => 'password',
            'umpteenth' => 'password',
            'lepidity' => 'password',
            'resplendent' => 'password',
            'rebullition' => 'password',
            'gruntled' => 'password',
            'meteorograph' => 'password',
            'chimerical' => 'password',
            'vesicate' => 'password',
            'blinker' => 'password',
            'colugocdm1179' => 'password',
            'foofaraw' => 'password',
            'wasserman' => 'password',
            'wisecrack' => 'password',
            'grandeur' => 'password',
            'diaphanous' => 'password',
            'gaussfan91' => 'password',
            'shituation' => 'password',
            'yapness' => 'password',
            'corkscrew' => 'password',
            'syngamy' => 'password',
            'salve' => 'password',
            'oscilloscope' => 'password',
            'inaniloquent' => 'password',
            'solidum' => 'password',
            'pogonip' => 'password',
            'cataphract' => 'password',
            'ululation' => 'password'
        ];

        foreach ($user_passwords as $user => $password) {
            DB::table('user')->insert([
                'username' => $user,
                'password' => Hash::make($password),
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }
    }
}
