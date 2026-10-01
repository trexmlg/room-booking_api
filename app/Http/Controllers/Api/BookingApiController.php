<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookingApiController extends Controller
{
    public function show(Booking $booking)
    {
        return response()->json($booking->load('room'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => ['required', 'integer', 'exists:rooms,id'],
            'title' => ['required', 'string', 'max:255'],
            'booked_by' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
        ]);

        $overlap = Booking::where('room_id', $data['room_id'])
            ->where('starts_at', '<', $data['ends_at'])
            ->where('ends_at', '>', $data['starts_at'])
            ->exists();

        if ($overlap) {
            throw ValidationException::withMessages([
                'room_id' => 'Room is already booked for this period.',
            ]);
        }

        return response()->json(Booking::create($data)->load('room'), 201);
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'room_id' => ['sometimes', 'integer', 'exists:rooms,id'],
            'title' => ['sometimes', 'string', 'max:255'],
            'booked_by' => ['sometimes', 'string', 'max:255'],
            'starts_at' => ['sometimes', 'date'],
            'ends_at' => ['sometimes', 'date'],
        ]);

        if (isset($data['starts_at']) || isset($data['ends_at']) || isset($data['room_id'])) {
            $startsAt = $data['starts_at'] ?? $booking->starts_at;
            $endsAt = $data['ends_at'] ?? $booking->ends_at;
            $roomId = $data['room_id'] ?? $booking->room_id;

            $overlap = Booking::where('room_id', $roomId)
                ->where('id', '!=', $booking->id)
                ->where('starts_at', '<', $endsAt)
                ->where('ends_at', '>', $startsAt)
                ->exists();

            if ($overlap) {
                throw ValidationException::withMessages([
                    'room_id' => 'Room is already booked for this period.',
                ]);
            }
        }

        $booking->update($data);

        return response()->json($booking->fresh()->load('room'));
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response()->json(null, 204);
    }
}