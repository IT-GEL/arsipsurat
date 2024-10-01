<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasswordResetsSeeder extends Seeder
{
    public function run()
    {
        DB::table('password_resets')->insert([
            [
                'email' => 'user@example.com',
                'token' => bcrypt('sample-token'), // Replace with actual token logic if needed
                'created_at' => now(),
            ],
            // Add more rows as needed...
        ]);
    }
}
