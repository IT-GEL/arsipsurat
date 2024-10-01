<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItsSeeder extends Seeder
{
    public function run()
    {
        DB::table('i_t_s')->insert([
            [
                'id' => 3,
                'perihal' => 'Pembuatan Akun Shared Folder JKT-DS',
                'noSurat' => '0000001',
                'nama' => 'Hanna',
                'jabatan' => 'SPV',
                'divisi' => 'TC',
                'keterangan' => ' awdqadawdaw awdasdwad ',
                'tglSurat' => '2024-09-24',
                'ttd' => 'asdawd',
                'namaTtd' => 'asdaw',
                'ettd' => null,
                'created_at' => '2024-09-23 23:23:30',
                'updated_at' => '2024-09-23 23:23:30',
            ],
            // Add more rows as needed...
        ]);
    }
}
