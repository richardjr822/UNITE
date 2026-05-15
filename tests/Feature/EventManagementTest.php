<?php

use App\Models\Event;
use App\Models\User;

test('admin can create an event', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->post(route('events.store'), [
        'title' => 'Hackathon',
        'description' => '24-hour coding challenge.',
        'date' => now()->addDays(3)->toDateString(),
        'time' => '14:00',
        'venue' => 'Main Hall',
        'capacity' => 100,
        'status' => 'scheduled',
    ]);

    $response->assertRedirect(route('events.index'));
    $this->assertDatabaseHas('events', [
        'title' => 'Hackathon',
        'venue' => 'Main Hall',
    ]);
});

test('student cannot create an event', function () {
    $student = User::factory()->student()->create();

    $response = $this->actingAs($student)->post(route('events.store'), [
        'title' => 'Blocked Event',
        'description' => 'Should fail.',
        'date' => now()->addDays(3)->toDateString(),
        'time' => '14:00',
        'venue' => 'Room 1',
        'capacity' => 20,
        'status' => 'scheduled',
    ]);

    $response->assertForbidden();
    $this->assertDatabaseMissing('events', [
        'title' => 'Blocked Event',
    ]);
});

test('event details page is accessible to authenticated users', function () {
    $student = User::factory()->student()->create();
    $event = Event::factory()->create();

    $response = $this->actingAs($student)->get(route('events.show', $event));

    $response->assertOk();
    $response->assertSee($event->title);
});
