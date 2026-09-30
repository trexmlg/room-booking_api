@extends('layout')

@section('title', 'Mājaslapas - Room Booking')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div>
        <h2 class="text-3xl font-bold text-gray-900">Sveiki! 👋</h2>
        <p class="text-gray-600 mt-2">Pārvaldiet telpas un rezervācijas efektīvi</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Rooms -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Kopā telpu</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalRooms }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">🏢</span>
                </div>
            </div>
        </div>

        <!-- Active Rooms -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Aktīvās telpas</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $activeRooms }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">✓</span>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Kopējās rezervācijas</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBookings }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">📅</span>
                </div>
            </div>
        </div>

        <!-- Upcoming Bookings -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Tuvojošās rezervācijas</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $upcomingBookings }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">⏰</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ātrās darbības</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('rooms.create') }}" class="flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                <span class="mr-2">+</span> Pievienot telpu
            </a>
            <a href="{{ route('bookings.create') }}" class="flex items-center justify-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                <span class="mr-2">📅</span> Nova rezervācija
            </a>
            <a href="{{ route('rooms.index') }}" class="flex items-center justify-center px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 font-medium rounded-lg transition">
                <span class="mr-2">👀</span> Skatīt visas telpas
            </a>
        </div>
    </div>

    <!-- Recent Bookings -->
    @if ($recentBookings->count() > 0)
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Jaunākās rezervācijas</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Telpa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nosaukums</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Rezervāciju veicējs</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Laiks</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($recentBookings as $booking)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $booking->room->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->booked_by }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->starts_at->format('Y-m-d H:i') }} - {{ $booking->ends_at->format('H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection