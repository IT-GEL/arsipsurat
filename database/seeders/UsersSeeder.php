<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'itsupport',
                'NIK' => null,
                'name' => 'IT Support',
                'Jabatan' => null,
                'email' => 'it@gel.co.id',
                'email_verified_at' => null,
                'password' => Hash::make('password'), // Replace with actual hashed password
                'remember_token' => null,
                'created_at' => '2024-09-09 21:40:26',
                'updated_at' => '2024-09-09 21:40:26',
            ],
            [
                'id' => 2,
                'username' => 'generalaffair',
                'NIK' => null,
                'name' => 'General Affair',
                'Jabatan' => null,
                'email' => 'GeneralAffair@gel.co.id',
                'email_verified_at' => null,
                'password' => Hash::make('password'), // Replace with actual hashed password
                'remember_token' => null,
                'created_at' => '2024-09-09 23:48:15',
                'updated_at' => '2024-09-09 23:48:15',
            ],
            [
                'id' => 3,
                'username' => 'hmss',
                'NIK' => null,
                'name' => 'Ervina Wijaya',
                'Jabatan' => null,
                'email' => 'hmss@gel.co.id',
                'email_verified_at' => null,
                'password' => Hash::make('password'), // Replace with actual hashed password
                'remember_token' => null,
                'created_at' => '2024-09-09 23:48:15',
                'updated_at' => '2024-09-09 23:48:15',
            ],
        ]);
    }
}
