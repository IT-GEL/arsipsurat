<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MSSSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_s_s')->insert([
            [
                'id' => 4,
                'noSurat' => '2',
                'prefix' => 'Ref. No:MSS/GEL/FCO-002/IX/2024',
                'idPerihal' => 1,
                'perihal' => 'Full Corporate Offer',
                'perihalBA' => null,
                'pttujuan' => 'PT Borneo',
                'ptkunjungan' => null,
                'commodity' => 'adcsfvacfvcad',
                'source' => 'acdscdc',
                'alamat' => '<div>&nbsp;oytiruesgerxhdtcyjukilho;jpolivkucjyrxtehzxthcyjuvkbil</div>',
                'keterangan' => null,
                'country' => 'acwdsawcdas',
                'spec' => 'awcddaw',
                'vo' => '2024-09-24',
                'qty' => 234,
                'lp' => 'Jetty Kalsel',
                'dp' => 'Jetty PT.BAP',
                'matauang' => 'DOLLAR',
                'cif' => 23212342,
                'fob' => 12343123,
                'freight' => null,
                'shipschedule' => '2024-09-24',
                'tcd' => 'CIF',
                'surveyor' => 'ATQ',
                'qas' => '<p>awdqadawdaw</p><p>awdasdwad</p><p><br></p>',
                'top' => 'yaaa',
                'delivery_basis' => null,
                'contract_dur' => null,
                'po' => null,
                'tglSurat' => '2024-09-24',
                'ttd' => 'asdawd',
                'namaTtd' => 'asdaw',
                'kop' => 'QIN',
                'qr' => null,
                'approve' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add other entries as necessary
        ]);
    }
}
