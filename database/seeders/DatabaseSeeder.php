<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create demo users
        $admin = User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $student = User::factory()->student()->create([
            'name' => 'Student User',
            'email' => 'student@example.com',
        ]);

        // Create sample events for testing
        $event1 = Event::factory()->create([
            'title' => 'Inter-College Hackathon',
            'description' => 'A 24-hour coding challenge where students collaborate to build innovative solutions. Teams will compete for prizes and networking opportunities.',
            'date' => now()->addDays(5)->toDateString(),
            'time' => '14:00',
            'venue' => 'Function Hall',
            'capacity' => 100,
            'status' => 'scheduled',
        ]);

        $event2 = Event::factory()->create([
            'title' => 'Annual Science Fair',
            'description' => 'Showcase of student research projects and scientific innovations across all disciplines. Judges will evaluate presentations and award top projects.',
            'date' => now()->addDays(6)->toDateString(),
            'time' => '10:00',
            'venue' => 'PE Hall',
            'capacity' => 150,
            'status' => 'scheduled',
        ]);

        $event3 = Event::factory()->create([
            'title' => 'Cultural Night',
            'description' => 'An evening celebration of diverse cultures featuring music, dance, and cuisine from around the world. All students welcome to participate.',
            'date' => now()->addDays(7)->toDateString(),
            'time' => '18:00',
            'venue' => 'Room 518',
            'capacity' => 80,
            'status' => 'scheduled',
        ]);

        // Register the demo student for one event
        $student->events()->attach($event1->id);
    }
}
