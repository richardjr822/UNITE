<?php

use App\Models\Event;
use App\Models\User;

test('student can register for an event once', function () {
    $student = User::factory()->student()->create();
    $event = Event::factory()->create(['capacity' => 2]);

    $response = $this->actingAs($student)->post(route('events.register', $event));

    $response->assertRedirect(route('events.show', $event));
    $this->assertDatabaseHas('event_user', [
        'user_id' => $student->id,
        'event_id' => $event->id,
    ]);

    $secondResponse = $this->actingAs($student)->post(route('events.register', $event));
    $secondResponse->assertSessionHasErrors('registration');
});

test('registration is blocked when event is full', function () {
    $firstStudent = User::factory()->student()->create();
    $secondStudent = User::factory()->student()->create();
    $event = Event::factory()->create(['capacity' => 1]);

    $this->actingAs($firstStudent)->post(route('events.register', $event));

    $fullAttempt = $this->actingAs($secondStudent)->post(route('events.register', $event));

    $fullAttempt->assertSessionHasErrors('registration');
});

test('admin cannot register as participant', function () {
    $admin = User::factory()->admin()->create();
    $event = Event::factory()->create();

    $response = $this->actingAs($admin)->post(route('events.register', $event));

    $response->assertForbidden();
});
