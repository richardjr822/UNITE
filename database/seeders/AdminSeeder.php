<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the admin user account.
     *
     * Uses firstOrCreate so running the seeder multiple times is safe.
     */
    public function run(): void
    {
        // Original admin account
        User::firstOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // New administrator account
        User::firstOrCreate(
            ['email' => 'administrator@school.edu'],
            [
                'name'     => 'administrator',
                'password' => Hash::make('Admin123!'),
                'role'     => 'admin',
            ]
        );
    }
}
