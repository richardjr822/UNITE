<?php
// database/seeders/EventSeeder.php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Seed upcoming school events.
     *
     * All dates are relative to now() so they remain in the future regardless
     * of when the seeder is run.
     */
    public function run(): void
    {
        $events = [
            [
                'title'       => 'Foundation Day Celebration',
                'description' => 'Annual school foundation day featuring cultural performances, academic exhibits, and recognition of outstanding students and faculty.',
                'date'        => Carbon::now()->addDays(14)->toDateString(),
                'time'        => '08:00:00',
                'venue'       => 'School Covered Court',
                'capacity'    => 500,
            ],
            [
                'title'       => 'Science and Technology Fair',
                'description' => 'Students showcase research projects and inventions across disciplines including robotics, environmental science, and applied technology.',
                'date'        => Carbon::now()->addDays(21)->toDateString(),
                'time'        => '09:00:00',
                'venue'       => 'Science Building Lobby',
                'capacity'    => 200,
            ],
            [
                'title'       => 'Leadership Summit 2026',
                'description' => 'A one-day summit for student council officers and class representatives focused on governance, communication, and community service.',
                'date'        => Carbon::now()->addDays(30)->toDateString(),
                'time'        => '07:30:00',
                'venue'       => 'School Auditorium',
                'capacity'    => 150,
            ],
            [
                'title'       => 'Inter-Class Sports Festival',
                'description' => 'A week-long sports tournament featuring basketball, volleyball, badminton, and track-and-field events open to all enrolled students.',
                'date'        => Carbon::now()->addDays(45)->toDateString(),
                'time'        => '06:30:00',
                'venue'       => 'School Athletic Field',
                'capacity'    => 800,
            ],
            [
                'title'       => 'Graduation Ceremony — Batch 2026',
                'description' => 'Commencement exercises for the graduating class of 2026. Attendance is required for all graduating students. Guests limited to two per graduate.',
                'date'        => Carbon::now()->addDays(60)->toDateString(),
                'time'        => '14:00:00',
                'venue'       => 'Main Gymnasium',
                'capacity'    => 1000,
            ],
        ];

        foreach ($events as $event) {
            Event::firstOrCreate(
                ['title' => $event['title']],
                $event
            );
        }
    }
}
