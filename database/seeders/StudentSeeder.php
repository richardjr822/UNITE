<?php
// database/seeders/StudentSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Seed student user accounts.
     *
     * Uses firstOrCreate so running the seeder multiple times is safe.
     */
    public function run(): void
    {
        $students = [
            [
                'name'     => 'Richard Del Carmen Jr',
                'email'    => 'richard@school.com',
                'password' => Hash::make('password'),
                'role'     => 'student',
            ],
            [
                'name'     => 'Francis Emil Rosete',
                'email'    => 'francis@school.com',
                'password' => Hash::make('password'),
                'role'     => 'student',
            ],
            // New student account — ID number as name and email prefix
            [
                'name'     => '202310589',
                'email'    => '202310589@school.edu',
                'password' => Hash::make('202310589'),
                'role'     => 'student',
            ],
        ];

        foreach ($students as $student) {
            User::firstOrCreate(
                ['email' => $student['email']],
                $student
            );
        }
    }
}
