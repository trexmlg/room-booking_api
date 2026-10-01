<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', [
        'totalRooms' => Room::count(),
        'activeRooms' => Room::active()->count(),
        'totalBookings' => Booking::count(),
        'upcomingBookings' => Booking::where('starts_at', '>', now())->count(),
        'recentBookings' => Booking::with('room')->latest()->limit(5)->get(),
    ]);
})->name('dashboard');

Route::resource('rooms', RoomController::class);
Route::resource('bookings', BookingController::class)->only(['index', 'create', 'store', 'destroy']);
