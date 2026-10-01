<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::withCount('bookings')->orderBy('name')->get();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
            'location' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $room = Room::create($data);

        if ($request->expectsJson()) {
            return response()->json($room, 201);
        }

        return redirect()->route('rooms.show', $room)->with('success', 'Telpa veiksmīgi izveidota.');
    }

    public function show(Room $room)
    {
        $todayBookings = $room->bookings()
            ->whereDate('starts_at', today())
            ->orderBy('starts_at')
            ->get();
        $upcomingBookings = $room->bookings()
            ->where('starts_at', '>', now())
            ->orderBy('starts_at')
            ->limit(5)
            ->get();

        return view('rooms.show', compact('room', 'todayBookings', 'upcomingBookings'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
            'location' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $room->update($data);

        return $request->expectsJson()
            ? response()->json($room)
            : redirect()->route('rooms.show', $room)->with('success', 'Telpa veiksmīgi atjaunināta.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->noContent();
    }
}
