<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Order matters:
     *  1. AdminSeeder  — creates the admin account
     *  2. StudentSeeder — creates student accounts
     *  3. EventSeeder  — creates upcoming school events
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            StudentSeeder::class,
            EventSeeder::class,
        ]);
    }
}
