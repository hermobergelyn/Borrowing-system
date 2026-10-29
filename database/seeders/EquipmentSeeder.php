<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = [
            [
                'name' => 'Basketball Official Size',
                'category' => 'Balls',
                'total_quantity' => 10,
                'available_quantity' => 10,
                'status' => 'Available',
            ],
            [
                'name' => 'Badminton Racket Set',
                'category' => 'Rackets',
                'total_quantity' => 15,
                'available_quantity' => 15,
                'status' => 'Available',
            ],
            [
                'name' => 'Volleyball',
                'category' => 'Balls',
                'total_quantity' => 8,
                'available_quantity' => 8,
                'status' => 'Available',
            ],
            [
                'name' => 'Pickle Ball',
                'category' => 'Rackets/Paddles',
                'total_quantity' => 20,
                'available_quantity' => 20,
                'status' => 'Available',
            ],
        ];

        foreach ($equipments as $equipment) {
            Equipment::updateOrCreate(
                ['name' => $equipment['name']],
                $equipment
            );
        }
    }
}