<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FailedJobsSeeder extends Seeder
{
    public function run()
    {
        DB::table('failed_jobs')->insert([
            [
                'uuid' => (string) Str::uuid(),
                'connection' => 'database',
                'queue' => 'default',
                'payload' => json_encode(['job' => 'ExampleJob', 'data' => []]),
                'exception' => 'Exception message here',
                'failed_at' => now(),
            ],
            // Add more rows as needed...
        ]);
    }
}
