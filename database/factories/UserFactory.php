<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'student',
            'gender' => fake()->randomElement(['female', 'male']),
            'phone' => fake()->numerify('09#########'),
            'course_section' => 'BSIT 1A',
            'profile_completed_at' => now(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user): void {
            $role = strtolower(trim($user->role));
            $identifierField = match ($role) {
                'student' => 'student_id',
                'staff', 'pe_instructor', 'pe instructor', 'admin', 'administrator', 'sports coordinator' => 'employee_id',
                default => null,
            };

            if ($identifierField !== null && blank($user->{$identifierField})) {
                $identifierPrefix = $identifierField === 'student_id' ? 'STU' : 'EMP';

                $user->forceFill([
                    $identifierField => sprintf('%s-%06d', $identifierPrefix, $user->getKey()),
                ])->save();
            }
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
