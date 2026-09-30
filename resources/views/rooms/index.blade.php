@extends('layout')

@section('title', 'Telpas - Room Booking')

@section('content')
<div class="space-y-6">
    <!-- Header with Action Button -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Telpas</h2>
            <p class="text-gray-600 mt-1">Pārvaldiet jūsu organizācijas telpas</p>
        </div>
        <a href="{{ route('rooms.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
            <span class="mr-2">+</span> Pievienot jaunu telpu
        </a>
    </div>

    <!-- Rooms Grid -->
    @if ($rooms->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($rooms as $room)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition overflow-hidden">
                <div class="p-6">
                    <!-- Room Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $room->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $room->location }}</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium {{ $room->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $room->is_active ? 'Aktīva' : 'Neaktīva' }}
                        </span>
                    </div>

                    <!-- Room Details -->
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-gray-600">
                            <span class="text-lg mr-2">👥</span>
                            <span>Ietilpība: <strong>{{ $room->capacity }}</strong> cilvēki</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <span class="text-lg mr-2">📅</span>
                            <span>Kopējās rezervācijas: <strong>{{ $room->bookings_count ?? 0 }}</strong></span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <a href="{{ route('rooms.show', $room) }}" class="flex-1 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium rounded-lg transition text-center text-sm">
                            Skatīt grafiku
                        </a>
                        <a href="{{ route('rooms.edit', $room) }}" class="flex-1 px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition text-center text-sm">
                            Rediģēt
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <div class="text-4xl mb-4">🏢</div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Nav telpu</h3>
            <p class="text-gray-600 mb-6">Sāciet ar pievienošanu jaunas telpas</p>
            <a href="{{ route('rooms.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                <span class="mr-2">+</span> Pievienot telpu
            </a>
        </div>
    @endif
</div>
@endsection