<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = Room::pluck('id')->values();
        $date = Carbon::now()->addDay()->startOfDay();
        $bookings = [];

        foreach ($rooms as $roomIndex => $roomId) {
            for ($slot = 0; $slot < 3; $slot++) {
                $start = $date->copy()->addHours(9 + ($slot * 2) + ($roomIndex % 2));
                $bookings[] = [
                    'room_id' => $roomId,
                    'title' => ['Team meeting', 'Project planning', 'Client presentation'][$slot],
                    'booked_by' => ['Anna', 'Toms', 'Laura', 'Jānis', 'Marta'][$roomIndex % 5],
                    'starts_at' => $start,
                    'ends_at' => $start->copy()->addHour(),
                ];
            }
        }

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
