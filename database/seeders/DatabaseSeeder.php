<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Create Default Users
        User::updateOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name' => 'Sports Coordinator Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@school.com'],
            [
                'name' => 'PE Instructor Staff',
                'password' => Hash::make('password123'),
                'role' => 'staff',
            ]
        );

        User::updateOrCreate(
            ['email' => 'student@school.com'],
            [
                'name' => 'Student Test',
                'password' => Hash::make('password123'),
                'role' => 'student',
            ]
        );

        // 2. Call EquipmentSeeder
        $this->call([
            EquipmentSeeder::class,
        ]);
    }
}