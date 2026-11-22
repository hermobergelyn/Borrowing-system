<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $defaultUsers = [
            [
                'email' => 'admin@school.com',
                'name' => 'Sports Coordinator Admin',
                'role' => 'admin',
            ],
            [
                'email' => 'staff@school.com',
                'name' => 'PE Instructor Staff',
                'role' => 'staff',
            ],
            [
                'email' => 'student@school.com',
                'name' => 'Student Test',
                'role' => 'student',
            ],
        ];
        $passwordHash = Hash::make('password123');

        foreach ($defaultUsers as $attributes) {
            $user = User::firstOrCreate(
                ['email' => $attributes['email']],
                [
                    'name' => $attributes['name'],
                    'password' => $passwordHash,
                    'role' => $attributes['role'],
                    'gender' => null,
                    'phone' => null,
                ]
            );

            $identifierField = $attributes['role'] === 'student' ? 'student_id' : 'employee_id';
            $identifierPrefix = $attributes['role'] === 'student' ? 'STU' : 'EMP';

            $user->forceFill([
                'name' => $attributes['name'],
                'password' => $passwordHash,
                'role' => $attributes['role'],
                'profile_completed_at' => $user->profile_completed_at ?? now(),
                $identifierField => filled($user->{$identifierField})
                    ? $user->{$identifierField}
                    : sprintf('%s-%06d', $identifierPrefix, $user->getKey()),
                'gender' => $user->gender,
                'phone' => $user->phone,
            ])->save();
        }

        $this->call([
            EquipmentSeeder::class,
        ]);
    }
}
