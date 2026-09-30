@extends('layout')

@section('title', 'Rediģēt ' . $room->name . ' - Room Booking')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('rooms.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium mb-4">
            <span class="mr-2">←</span> Atpakaļ
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Rediģēt telpu</h2>
        <p class="text-gray-600 mt-2">{{ $room->name }}</p>
    </div>

    <!-- Form -->
    <form action="{{ route('rooms.update', $room) }}" method="POST" class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 space-y-6">
        @csrf
        @method('PUT')

        <!-- Telpa nosaukums -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Telpa nosaukums *</label>
            <input type="text" id="name" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition {{ $errors->has('name') ? 'border-red-500' : '' }}" value="{{ old('name', $room->name) }}">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Ietilpība -->
        <div>
            <label for="capacity" class="block text-sm font-semibold text-gray-900 mb-2">Ietilpība (cilvēki) *</label>
            <input type="number" id="capacity" name="capacity" required min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition {{ $errors->has('capacity') ? 'border-red-500' : '' }}" value="{{ old('capacity', $room->capacity) }}">
            @error('capacity')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Atrašanās vieta -->
        <div>
            <label for="location" class="block text-sm font-semibold text-gray-900 mb-2">Atrašanās vieta *</label>
            <input type="text" id="location" name="location" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition {{ $errors->has('location') ? 'border-red-500' : '' }}" value="{{ old('location', $room->location) }}">
            @error('location')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Aktīva -->
        <div>
            <label for="is_active" class="flex items-center">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $room->is_active) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                <span class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer">Telpa ir aktīva</span>
            </label>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-6 border-t border-gray-200">
            <a href="{{ route('rooms.index') }}" class="flex-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-900 font-medium rounded-lg transition text-center">
                Atcelt
            </a>
            <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                Saglabāt izmaiņas
            </button>
        </div>
    </form>
</div>
@endsection