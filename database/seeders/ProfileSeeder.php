<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        DB::table('profile')->insert([
            [
                'id' => 1,
                'name' => 'test',
                'NIK' => 'test01',
                'Jabatan' => 'jabatantest',
                'created_at' => '2024-09-19 02:54:05',
            ],
            // Add more rows as needed...
        ]);
    }
}
