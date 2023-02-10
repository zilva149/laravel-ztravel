<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Zilvinas',
            'role' => '3',
            'email' => 'zilvinas@gmail.com',
            'password' => Hash::make('zilvinas123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Monika',
            'role' => '1',
            'email' => 'monika@gmail.com',
            'password' => Hash::make('monika123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Edvinas',
            'role' => '1',
            'email' => 'edvinas@gmail.com',
            'password' => Hash::make('edvinas123'),
        ]);

        DB::table('countries')->insert([
            'name' => 'Makedonija',
            'continent' => 'Europa',
            'season_start' => '2023-02-05',
            'season_end' => '2023-02-11',
        ]);

        DB::table('countries')->insert([
            'name' => 'Brazilija',
            'continent' => 'Pietų Amerika',
            'season_start' => '2023-06-14',
            'season_end' => '2023-07-14',
        ]);

        DB::table('countries')->insert([
            'name' => 'Portugalija',
            'continent' => 'Europa',
            'season_start' => '2023-05-20',
            'season_end' => '2023-09-14',
        ]);
    }
}
