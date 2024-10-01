<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GasSeeder extends Seeder
{
    public function run()
    {
        DB::table('g_a_s')->insert([
            [
                'id' => 1,
                'noSurat' => '82',
                'nama' => 'Bettie Kozey',
                'pt' => '',
                'vendor' => '',
                'tempatTglLahir' => 'doloribus',
                'keterangan' => 'Et nisi harum corrupti voluptas eos rerum ullam. Molestias natus dolor qui dolor.... Ad sed voluptas aut omnis architecto.',
                'tglSurat' => '2019-05-29',
                'ttd' => 'voluptas',
                'namaTtd' => 'velit',
                'created_at' => '2024-09-08 20:35:13',
                'updated_at' => '2024-09-08 20:35:13',
            ],
            // Add more rows as needed...
        ]);
    }
}
