<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // سایر سیيدرها (در صورت وجود)
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}
