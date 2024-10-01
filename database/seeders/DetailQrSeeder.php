<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailQrSeeder extends Seeder
{
    public function run()
    {
        DB::table('detail_qr')->insert([
            [
                'id' => 4,
                'nosurat' => 'BA-002/INV-SALES/IX/2024',
                'nama' => 'Ervina Wijaya',
                'NIK' => null,
                'jabatan' => 'Head Departement Shipping and Sales',
                'qr' => 'QRMSS6.png',
                'approve_at' => '2024-09-23 00:55:51',
                'created_at' => '2024-09-23 00:55:51',
                'updated_at' => '2024-09-23 00:55:51',
            ],
            // Add more rows as needed...
        ]);
    }
}
