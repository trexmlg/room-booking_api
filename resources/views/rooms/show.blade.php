@extends('layout')

@section('title', $room->name . ' - Room Booking')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('rooms.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium mb-2">
                <span class="mr-2">←</span> Atpakaļ
            </a>
            <h2 class="text-3xl font-bold text-gray-900">{{ $room->name }}</h2>
            <p class="text-gray-600 mt-1">{{ $room->location }} • Ietilpība: {{ $room->capacity }} cilvēki</p>
        </div>
        <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
            <span class="mr-2">+</span> Nova rezervācija
        </a>
    </div>

    <!-- Schedule for Today -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Dienas grafiks ({{ now()->format('Y-m-d') }})</h3>
        </div>
        @if ($todayBookings->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach ($todayBookings as $booking)
                <div class="p-6 hover:bg-gray-50 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">{{ $booking->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">Rezervāciju veicējs: <strong>{{ $booking->booked_by }}</strong></p>
                            <div class="flex items-center space-x-4 mt-3 text-sm">
                                <span class="text-gray-700">⏱️ {{ $booking->starts_at->format('H:i') }} - {{ $booking->ends_at->format('H:i') }}</span>
                                <span class="text-gray-500">{{ $booking->starts_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            @if ($booking->starts_at <= now() && $booking->ends_at > now())
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">Šobrīd notiek</span>
                            @elseif ($booking->starts_at > now())
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">Plānots</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">Pabeigts</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center">
                <p class="text-gray-600">Šodien nav rezervāciju</p>
            </div>
        @endif
    </div>

    <!-- Upcoming Bookings -->
    @if ($upcomingBookings->count() > 0)
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Tuvojošās rezervācijas</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nosaukums</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Rezervāciju veicējs</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Sākums</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Beigas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($upcomingBookings as $booking)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $booking->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->booked_by }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->starts_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->ends_at->format('H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection