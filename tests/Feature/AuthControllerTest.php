<?php

use App\Models\User;

it('registers api users with gender, contact number, and a generated student id', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'API Student',
        'email' => 'api.student@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'gender' => 'female',
        'phone' => '09462717365',
    ]);

    $response
        ->assertCreated()
        ->assertJsonPath('user.role', 'student')
        ->assertJsonPath('user.gender', 'female')
        ->assertJsonPath('user.phone', '09462717365');

    $user = User::where('email', 'api.student@example.com')->firstOrFail();

    $this->assertModelExists($user);
    expect($user->student_id)->toMatch('/^STU-\d{6}$/');
});

it('returns validation errors when api registration omits gender or contact number', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'API Student',
        'email' => 'api.student@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['gender', 'phone']);

    $this->assertDatabaseMissing('users', [
        'email' => 'api.student@example.com',
    ]);
});
