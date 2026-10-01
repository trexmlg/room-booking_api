<?php

use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\RoomApiController;
use Illuminate\Support\Facades\Route;

Route::get('/rooms', [RoomApiController::class, 'index']);
Route::post('/rooms', [RoomApiController::class, 'store']);
Route::get('/rooms/{room}', [RoomApiController::class, 'show']);
Route::get('/rooms/{room}/schedule/{date}', [RoomApiController::class, 'schedule']);
Route::get('/rooms/{room}/current', [RoomApiController::class, 'current']);
Route::get('/rooms/{room}/upcoming', [RoomApiController::class, 'upcoming']);
Route::post('/bookings', [BookingApiController::class, 'store']);
