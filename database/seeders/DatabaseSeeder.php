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
            'season_start' => '2023-03-05',
            'season_end' => '2024-09-09',
        ]);

        DB::table('countries')->insert([
            'name' => 'Brazilija',
            'continent' => 'Pietų Amerika',
            'season_start' => '2023-03-19',
            'season_end' => '2024-04-24',
        ]);

        DB::table('countries')->insert([
            'name' => 'Portugalija',
            'continent' => 'Europa',
            'season_start' => '2023-03-10',
            'season_end' => '2024-04-11',
        ]);

        DB::table('destinations')->insert([
            'name' => 'Ochridas ir Ochrido ežeras',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'country_id' => '1',
        ]);

        DB::table('destinations')->insert([
            'name' => 'Pantanalis',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'country_id' => '2',
        ]);

        DB::table('destinations')->insert([
            'name' => 'Igvasu kriokliai',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'country_id' => '2',
        ]);

        DB::table('destinations')->insert([
            'name' => 'Amazonija',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'country_id' => '2',
        ]);

        DB::table('destinations')->insert([
            'name' => 'Alkevos užtvanka',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'country_id' => '3',
        ]);

        DB::table('destinations')->insert([
            'name' => 'Cabo de Vicentina',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'country_id' => '3',
        ]);

        DB::table('destinations')->insert([
            'name' => 'Peneda-Geres',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'country_id' => '3',
        ]);

        DB::table('destinations')->insert([
            'name' => 'Sierra de Monchique',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'country_id' => '3',
        ]);

        DB::table('hotels')->insert([
            'name' => 'Geltona palapinė',
            'address' => 'džiunklių karalystė 14',
            'people_limit' => '4',
            'destination_id' => '4',
            'country_id' => '2',
        ]);

        DB::table('hotels')->insert([
            'name' => 'Namas medyje',
            'address' => 'džiunklių karalystė 18',
            'people_limit' => '2',
            'destination_id' => '4',
            'country_id' => '2',
        ]);

        DB::table('hotels')->insert([
            'name' => 'Kelmučių bokštas',
            'address' => 'Korsepcų pieva 29',
            'people_limit' => '9',
            'destination_id' => '7',
            'country_id' => '3',
        ]);

        DB::table('hotels')->insert([
            'name' => 'Girios Troba',
            'address' => 'Močiutės sklypas 55',
            'people_limit' => '7',
            'destination_id' => '7',
            'country_id' => '3',
        ]);

        DB::table('hotels')->insert([
            'name' => 'Prabangos dvelksmas',
            'address' => 'Oro oras 7',
            'people_limit' => '5',
            'destination_id' => '8',
            'country_id' => '3',
        ]);

        DB::table('hotels')->insert([
            'name' => 'Baltos naktys',
            'address' => 'Nakties alėja 19',
            'people_limit' => '5',
            'destination_id' => '8',
            'country_id' => '3',
        ]);

        DB::table('hotels')->insert([
            'name' => 'Vandens pilis',
            'address' => 'Ežero vidurys 17',
            'people_limit' => '4',
            'destination_id' => '1',
            'country_id' => '1',
        ]);

        DB::table('hotels')->insert([
            'name' => 'Viliaus namai',
            'address' => 'Krioklys 79',
            'people_limit' => '6',
            'destination_id' => '3',
            'country_id' => '2',
        ]);

        DB::table('offers')->insert([
            'name' => '10 dienų kelionė į Amazonės džiungles',
            'travel_start' => '2023-05-15',
            'travel_end' => '2023-05-25',
            'price' => '1099.99',
            'hotel_id' => '1',
            'destination_id' => '4',
            'country_id' => '2',
        ]);

        DB::table('offers')->insert([
            'name' => '14 dienų kelionė į Amazonės džiungles',
            'travel_start' => '2023-07-01',
            'travel_end' => '2023-07-15',
            'price' => '1399.99',
            'hotel_id' => '1',
            'destination_id' => '4',
            'country_id' => '2',
        ]);

        DB::table('offers')->insert([
            'name' => '7 dienos medyje',
            'travel_start' => '2023-06-21',
            'travel_end' => '2023-06-28',
            'price' => '1899.99',
            'hotel_id' => '1',
            'destination_id' => '4',
            'country_id' => '2',
        ]);

        DB::table('offers')->insert([
            'name' => '3 savaitės pievose',
            'travel_start' => '2023-08-01',
            'travel_end' => '2023-08-22',
            'price' => '1299.99',
            'hotel_id' => '3',
            'destination_id' => '7',
            'country_id' => '3',
        ]);

        DB::table('offers')->insert([
            'name' => '2 savaitės troboje',
            'travel_start' => '2023-10-01',
            'travel_end' => '2023-10-15',
            'price' => '999.99',
            'hotel_id' => '4',
            'destination_id' => '7',
            'country_id' => '3',
        ]);

        DB::table('offers')->insert([
            'name' => '9 dienos Portugalijos gamtoje',
            'travel_start' => '2023-08-10',
            'travel_end' => '2023-08-19',
            'price' => '1199.99',
            'hotel_id' => '5',
            'destination_id' => '8',
            'country_id' => '3',
        ]);

        DB::table('offers')->insert([
            'name' => 'Poilsis ežero centre',
            'travel_start' => '2023-06-10',
            'travel_end' => '2023-06-15',
            'price' => '699.99',
            'hotel_id' => '7',
            'destination_id' => '1',
            'country_id' => '1',
        ]);

        DB::table('offers')->insert([
            'name' => '12 dienų šalia krioklio didybės',
            'travel_start' => '2023-08-15',
            'travel_end' => '2023-08-27',
            'price' => '2499.99',
            'hotel_id' => '8',
            'destination_id' => '3',
            'country_id' => '2',
        ]);
    }
}
