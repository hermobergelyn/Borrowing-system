<?php

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertOk()
        ->assertSee('Gender')
        ->assertSee('Phone Number');
});

test('new users are sent to role selection after registering', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'gender' => 'female',
        'phone' => '09462717365',
        'role' => 'pe_instructor',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('role.select'));
    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'role' => '',
        'gender' => 'female',
        'phone' => '09462717365',
    ]);

    $this->get(route('role.select'))
        ->assertSee('Tell us how');
    $this->get(route('dashboard'))
        ->assertRedirect(route('role.select'));
});

test('new users complete their profile before reaching the selected dashboard', function (string $role, string $dashboardRoute, string $identifierField, string $identifierPrefix, array $profile) {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'gender' => 'female',
        'phone' => '09171234567',
    ])->assertRedirect(route('role.select'));

    $this->post(route('role.store'), [
        'role' => $role,
    ])->assertRedirect(route('profile.complete'));

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'role' => $role,
        'gender' => 'female',
        'phone' => '09171234567',
    ]);

    $user = User::where('email', 'test@example.com')->firstOrFail();
    $generatedIdentifier = sprintf('%s-%06d', $identifierPrefix, $user->id);
    $this->assertSame($generatedIdentifier, $user->{$identifierField});

    $this->get(route('profile.complete'))
        ->assertOk()
        ->assertSee($generatedIdentifier)
        ->assertDontSee('name="'.$identifierField.'"', false);

    $this->get(route('dashboard'))
        ->assertRedirect(route('profile.complete'));

    $this->post(route('profile.complete.store'), $profile)
        ->assertRedirect(route('dashboard'));

    $this->get(route('dashboard'))
        ->assertRedirect(route($dashboardRoute));
})->with([
    'student' => [
        'student',
        'student.dashboard',
        'student_id',
        'STU',
        [
            'course_section' => 'BSIT 3A',
        ],
    ],
    'PE instructor' => [
        'pe_instructor',
        'staff.dashboard',
        'employee_id',
        'EMP',
        [
            'department' => 'Physical Education',
        ],
    ],
]);

test('new Google users are sent to role selection', function () {
    Socialite::fake('google', SocialiteUser::fake([
        'id' => 'google-user-123',
        'name' => 'Google User',
        'email' => 'google@example.com',
    ]));

    $response = $this->get(route('auth.google.callback'));

    $response->assertRedirect(route('role.select'));
    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'email' => 'google@example.com',
        'google_id' => 'google-user-123',
        'role' => '',
    ]);
});

test('Google users complete common profile details after selecting a role', function () {
    Socialite::fake('google', SocialiteUser::fake([
        'id' => 'google-profile-123',
        'name' => 'Google Profile User',
        'email' => 'google-profile@example.com',
    ]));

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('role.select'));

    $this->post(route('role.store'), [
        'role' => 'student',
    ])->assertRedirect(route('profile.complete'));

    $this->post(route('profile.complete.store'), [
        'gender' => 'male',
        'phone' => '09171234568',
        'course_section' => 'BSIT 3A',
    ])->assertRedirect(route('dashboard'));

    $user = User::where('email', 'google-profile@example.com')->firstOrFail();

    $this->assertSame(sprintf('STU-%06d', $user->id), $user->student_id);
    $this->assertDatabaseHas('users', [
        'email' => 'google-profile@example.com',
        'gender' => 'male',
        'phone' => '09171234568',
        'course_section' => 'BSIT 3A',
    ]);
});

test('existing Google users keep their assigned dashboard', function () {
    $user = User::create([
        'name' => 'Existing Staff',
        'email' => 'existing@example.com',
        'password' => 'password',
        'google_id' => 'google-existing-123',
        'role' => 'staff',
    ]);
    $user->forceFill(['profile_completed_at' => now()])->save();

    Socialite::fake('google', SocialiteUser::fake([
        'id' => 'google-existing-123',
        'name' => $user->name,
        'email' => $user->email,
    ]));

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('dashboard'));

    $this->get(route('dashboard'))
        ->assertRedirect(route('staff.dashboard'));

    $this->post(route('role.store'), [
        'role' => 'pe_instructor',
    ])->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('users', [
        'email' => 'existing@example.com',
        'role' => 'staff',
    ]);
});

test('users with an assigned role cannot select another role', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'gender' => 'female',
        'phone' => '09171234567',
    ]);

    $this->post(route('role.store'), [
        'role' => 'student',
    ])->assertRedirect(route('profile.complete'));

    $this->post(route('role.store'), [
        'role' => 'pe_instructor',
    ])->assertRedirect(route('profile.complete'));

    $this->get(route('role.select'))
        ->assertRedirect(route('profile.complete'));

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'role' => 'student',
    ]);
});
