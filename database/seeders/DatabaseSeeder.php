<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\IT;
// use App\Models\GA;
// use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DetailQrSeeder::class,
            FailedJobsSeeder::class,
            GasSeeder::class,
            ItsSeeder::class,
            MssSeeder::class,
            ProfileSeeder::class,
            UsersSeeder::class,
            PasswordResetsSeeder::class,
        ]);
    }
}
