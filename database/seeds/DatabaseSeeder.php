<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'admin' => true,
            ]);

            for ($i = 0; $i < 10; $i++) {
                DB::table('users')->insert([
                    'name' => str_random(10),
                    'email' => str_random(10).'@gmail.com',
                    'password' => bcrypt('secret'),
                ]);
            }

    }
}
