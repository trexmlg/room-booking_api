@extends('layout')

@section('title', 'Nova rezervācija - Room Booking')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('bookings.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium mb-4">
            <span class="mr-2">←</span> Atpakaļ
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Izveidot jaunu rezervāciju</h2>
        <p class="text-gray-600 mt-2">Aizpildiet formu, lai rezervētu telpu</p>
    </div>

    <!-- Form -->
    <form action="{{ route('bookings.store') }}" method="POST" class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 space-y-6">
        @csrf

        <!-- Telpa -->
        <div>
            <label for="room_id" class="block text-sm font-semibold text-gray-900 mb-2">Telpa *</label>
            <select id="room_id" name="room_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition {{ $errors->has('room_id') ? 'border-red-500' : '' }}">
                <option value="">-- Izvēlieties telpu --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id', request('room_id')) == $room->id ? 'selected' : '' }}>{{ $room->name }} ({{ $room->location }})</option>
                @endforeach
            </select>
            @error('room_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nosaukums -->
        <div>
            <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">Rezervācijas nosaukums *</label>
            <input type="text" id="title" name="title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition {{ $errors->has('title') ? 'border-red-500' : '' }}" placeholder="piem., Tiešsaistes tikšanās" value="{{ old('title') }}">
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Rezervāciju veicējs -->
        <div>
            <label for="booked_by" class="block text-sm font-semibold text-gray-900 mb-2">Rezervāciju veicējs *</label>
            <input type="text" id="booked_by" name="booked_by" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition {{ $errors->has('booked_by') ? 'border-red-500' : '' }}" placeholder="piem., Jānis" value="{{ old('booked_by') }}">
            @error('booked_by')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Sākuma laiks -->
        <div>
            <label for="starts_at" class="block text-sm font-semibold text-gray-900 mb-2">Sākuma datums un laiks *</label>
            <input type="datetime-local" id="starts_at" name="starts_at" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition {{ $errors->has('starts_at') ? 'border-red-500' : '' }}" value="{{ old('starts_at') }}">
            @error('starts_at')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Beigu laiks -->
        <div>
            <label for="ends_at" class="block text-sm font-semibold text-gray-900 mb-2">Beigu datums un laiks *</label>
            <input type="datetime-local" id="ends_at" name="ends_at" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition {{ $errors->has('ends_at') ? 'border-red-500' : '' }}" value="{{ old('ends_at') }}">
            @error('ends_at')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Info message -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-blue-800">⚠️ Jāpārliecinās, ka jaunā rezervācija nepārklājas ar esošo</p>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-6 border-t border-gray-200">
            <a href="{{ route('bookings.index') }}" class="flex-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-900 font-medium rounded-lg transition text-center">
                Atcelt
            </a>
            <button type="submit" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                Izveidot rezervāciju
            </button>
        </div>
    </form>
</div>
@endsection