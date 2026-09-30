<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Meeting Room A',
                'capacity' => 8,
                'location' => '1. stāvs',
                'is_active' => true,
            ],
            [
                'name' => 'Meeting Room B',
                'capacity' => 6,
                'location' => '2. stāvs',
                'is_active' => true,
            ],
            [
                'name' => 'Conference Hall',
                'capacity' => 20,
                'location' => '3. stāvs',
                'is_active' => true,
            ],
            [
                'name' => 'Board Room',
                'capacity' => 12,
                'location' => '2. stāvs',
                'is_active' => true,
            ],
            [
                'name' => 'Team Room C',
                'capacity' => 4,
                'location' => '1. stāvs',
                'is_active' => true,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
