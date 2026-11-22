<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

it('creates an admin-managed user with profile details and a generated identifier', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(route('admin.users.store'), [
        'name' => 'New Student',
        'email' => 'new.student@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'student',
        'gender' => 'female',
        'phone' => '09462717365',
        'course_section' => 'BSIT 2A',
    ]);

    $response
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHasNoErrors();

    $user = User::where('email', 'new.student@example.com')->firstOrFail();

    $this->assertModelExists($user);
    expect($user->gender)->toBe('female');
    expect($user->phone)->toBe('09462717365');
    expect($user->course_section)->toBe('BSIT 2A');
    expect($user->student_id)->toMatch('/^STU-\d{6}$/');
    expect($user->profile_completed_at)->not->toBeNull();
});

it('creates an employee with contact details and a generated employee identifier', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(route('admin.users.store'), [
        'name' => 'New Instructor',
        'email' => 'new.instructor@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'staff',
        'gender' => 'male',
        'phone' => '09123456789',
        'department' => 'Physical Education',
    ]);

    $response
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHasNoErrors();

    $user = User::where('email', 'new.instructor@example.com')->firstOrFail();

    expect($user->gender)->toBe('male');
    expect($user->phone)->toBe('09123456789');
    expect($user->department)->toBe('Physical Education');
    expect($user->employee_id)->toMatch('/^EMP-\d{6}$/');
});

it('requires gender and contact number when an admin creates a user', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->from(route('admin.users.create'))->post(route('admin.users.store'), [
        'name' => 'Incomplete Student',
        'email' => 'incomplete.student@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'student',
        'course_section' => 'BSIT 2A',
    ]);

    $response
        ->assertRedirect(route('admin.users.create'))
        ->assertSessionHasErrors(['gender', 'phone']);

    $this->assertDatabaseMissing('users', [
        'email' => 'incomplete.student@example.com',
    ]);
});

it('updates profile details without allowing an admin to change the generated identifier', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create([
        'name' => 'Existing Student',
        'gender' => 'male',
        'phone' => '09123456789',
        'course_section' => 'BSIT 1A',
    ]);
    $studentId = $user->student_id;

    $this->actingAs($admin)
        ->get(route('admin.users.edit', $user))
        ->assertSee($studentId)
        ->assertSee('name="gender"', false)
        ->assertSee('name="phone"', false)
        ->assertDontSee('name="student_id"', false);

    $response = $this->put(route('admin.users.update', $user), [
        'name' => 'Updated Student',
        'email' => $user->email,
        'gender' => 'female',
        'phone' => '09462717365',
        'course_section' => 'BSIT 2A',
        'student_id' => 'STU-999999',
    ]);

    $response
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHasNoErrors();

    $user->refresh();

    expect($user->name)->toBe('Updated Student');
    expect($user->gender)->toBe('female');
    expect($user->phone)->toBe('09462717365');
    expect($user->course_section)->toBe('BSIT 2A');
    expect($user->student_id)->toBe($studentId);
});

it('updates employee gender, contact number, and department without changing the employee id', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create([
        'role' => 'staff',
        'gender' => 'female',
        'phone' => '09123456789',
        'department' => 'Old Department',
    ]);
    $employeeId = $user->employee_id;

    $response = $this->actingAs($admin)->put(route('admin.users.update', $user), [
        'name' => $user->name,
        'email' => $user->email,
        'gender' => 'male',
        'phone' => '09462717365',
        'department' => 'Physical Education',
        'employee_id' => 'EMP-999999',
    ]);

    $response
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHasNoErrors();

    $user->refresh();

    expect($user->gender)->toBe('male');
    expect($user->phone)->toBe('09462717365');
    expect($user->department)->toBe('Physical Education');
    expect($user->employee_id)->toBe($employeeId);
});

it('preserves existing gender and contact details when the database seeder runs', function () {
    $user = User::factory()->create([
        'name' => 'Existing Admin',
        'email' => 'admin@school.com',
        'role' => 'admin',
        'gender' => 'female',
        'phone' => '09462717365',
    ]);
    $user->forceFill([
        'employee_id' => null,
        'profile_completed_at' => null,
    ])->save();

    $this->seed(DatabaseSeeder::class);

    $user->refresh();

    expect($user->gender)->toBe('female');
    expect($user->phone)->toBe('09462717365');
    expect($user->employee_id)->toMatch('/^EMP-\d{6}$/');
    expect($user->profile_completed_at)->not->toBeNull();
});
