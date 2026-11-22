<?php

use App\Models\User;

test('profile shows editable details while generated identifiers stay read only', function () {
    $user = User::create([
        'name' => 'Test Student',
        'email' => 'profile@example.com',
        'password' => 'password',
        'role' => 'student',
        'gender' => 'male',
        'phone' => '09171234567',
        'course_section' => 'BSIT 3A',
    ]);

    $user->forceFill([
        'student_id' => 'STU-000042',
        'profile_completed_at' => now(),
    ])->save();

    $this->actingAs($user)
        ->get(route('profile.edit'))
        ->assertOk()
        ->assertSee('STU-000042')
        ->assertSee('name="course_section"', false)
        ->assertDontSee('name="student_id"', false);

    $this->patch(route('profile.update'), [
        'name' => 'Updated Student',
        'email' => 'profile@example.com',
        'gender' => 'female',
        'phone' => '09462717365',
        'course_section' => 'BSIT 3B',
        'student_id' => 'CHANGED-ID',
    ])->assertRedirect(route('profile.edit'));

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated Student',
        'gender' => 'female',
        'phone' => '09462717365',
        'course_section' => 'BSIT 3B',
        'student_id' => 'STU-000042',
    ]);
});
