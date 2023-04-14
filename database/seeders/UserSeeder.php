<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Marry Admin',
                'email' => 'admin1@gmail.com',
                'password' => 'admin123',
                'role' => 'admin',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Jack User',
                'email' => 'user1@gmail.com',
                'password' => 'user123',
                'role' => 'user',
                'created_at' => Carbon::now(),
            ],
        );
    }
}
