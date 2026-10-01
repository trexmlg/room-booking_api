<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoomApiController extends Controller
{
    public function index()
    {
        return response()->json(Room::active()->orderBy('name')->get(['id', 'name', 'capacity', 'location', 'is_active']));
    }

    public function show(Room $room)
    {
        return response()->json($room);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
            'location' => ['required', 'string', 'max:255'],
        ]);
        $room = Room::create($data + ['is_active' => true]);
        return response()->json($room, 201);
    }

    public function schedule(Room $room, string $date)
    {
        try {
            $day = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages(['date' => 'Date must use the YYYY-MM-DD format.']);
        }

        $bookings = $room->bookings()->where(function ($query) use ($day) {
            $query->where('starts_at', '<', $day->copy()->endOfDay())
                ->where('ends_at', '>', $day->copy()->startOfDay());
        })->orderBy('starts_at')->get(['title', 'booked_by', 'starts_at', 'ends_at']);

        return response()->json($bookings->map(fn (Booking $booking) => [
            'title' => $booking->title,
            'booked_by' => $booking->booked_by,
            'starts_at' => $booking->starts_at->format('H:i'),
            'ends_at' => $booking->ends_at->format('H:i'),
        ]));
    }

    public function current(Room $room)
    {
        $booking = $room->bookings()->where('starts_at', '<=', now())->where('ends_at', '>', now())->first();
        return response()->json([
            'occupied' => (bool) $booking,
            'booking' => $booking ? [
                'title' => $booking->title,
                'booked_by' => $booking->booked_by,
                'starts_at' => $booking->starts_at->format('H:i'),
                'ends_at' => $booking->ends_at->format('H:i'),
            ] : null,
        ]);
    }

    public function upcoming(Room $room)
    {
        return response()->json($room->bookings()->where('starts_at', '>', now())->orderBy('starts_at')->limit(5)->get());
    }
}
