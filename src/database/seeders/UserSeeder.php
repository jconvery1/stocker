<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define dummy data for users
        $data = [
            [
                'username' => 'manager',
                'password' => Hash::make('password1'), // Hash the password
                'email' => 'manager@gmail.com',
                'role' => 'manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'floor staff',
                'password' => Hash::make('password2'), // Hash the password
                'email' => 'floorstaff@gmail.com',
                'role' => 'floor staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the users table
        DB::table('users')->insert($data);
    }
}
