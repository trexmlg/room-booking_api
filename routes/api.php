<?php

use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\RoomApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('api.key')->group(function () {
    Route::get('/rooms', [RoomApiController::class, 'index']);
    Route::post('/rooms', [RoomApiController::class, 'store']);
    Route::get('/rooms/{room}', [RoomApiController::class, 'show']);
    Route::put('/rooms/{room}', [RoomApiController::class, 'update']);
    Route::delete('/rooms/{room}', [RoomApiController::class, 'destroy']);

    Route::get('/rooms/{room}/schedule/{date}', [RoomApiController::class, 'schedule']);
    Route::get('/rooms/{room}/current', [RoomApiController::class, 'current']);
    Route::get('/rooms/{room}/upcoming', [RoomApiController::class, 'upcoming']);

    Route::get('/bookings/{booking}', [BookingApiController::class, 'show']);
    Route::post('/bookings', [BookingApiController::class, 'store']);
    Route::put('/bookings/{booking}', [BookingApiController::class, 'update']);
    Route::delete('/bookings/{booking}', [BookingApiController::class, 'destroy']);
});