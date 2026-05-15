<?php

use App\Models\User;

test('admin login page can be rendered', function () {
    $response = $this->get('/login/admin');

    $response->assertOk();
    $response->assertSee('Admin');
});

test('student account cannot login through admin flow', function () {
    $student = User::factory()->student()->create([
        'email' => 'student-role@test.com',
    ]);

    $response = $this->post('/login/admin', [
        'email' => $student->email,
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('admin account can login through admin flow', function () {
    $admin = User::factory()->admin()->create([
        'email' => 'admin-role@test.com',
    ]);

    $response = $this->post('/login/admin', [
        'email' => $admin->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('dashboard', absolute: false));
    $this->assertAuthenticated();
});
