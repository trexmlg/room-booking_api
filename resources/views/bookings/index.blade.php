@extends('layout')

@section('title', 'Rezervācijas - Room Booking')

@section('content')
<div class="space-y-6">
    <!-- Header with Action Button -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Rezervācijas</h2>
            <p class="text-gray-600 mt-1">Pārvaldiet visas telpas rezervācijas</p>
        </div>
        <a href="{{ route('bookings.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
            <span class="mr-2">+</span> Nova rezervācija
        </a>
    </div>

    <!-- Bookings Table -->
    @if ($bookings->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Telpa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nosaukums</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Rezervāciju veicējs</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Sākums</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Beigas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Statuss</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $booking->room->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->booked_by }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->starts_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->ends_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4">
                                @if ($booking->starts_at <= now() && $booking->ends_at > now())
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">Notiek</span>
                                @elseif ($booking->starts_at > now())
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">Plānots</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">Pabeigts</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <div class="text-4xl mb-4">📅</div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Nav rezervāciju</h3>
            <p class="text-gray-600 mb-6">Sāciet ar jauna rezervācijas izveidi</p>
            <a href="{{ route('bookings.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                <span class="mr-2">+</span> Nova rezervācija
            </a>
        </div>
    @endif
</div>
@endsection