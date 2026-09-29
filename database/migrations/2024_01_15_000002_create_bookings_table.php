<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('booked_by');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->timestamps();

            
            $table->index('room_id');
            $table->index('starts_at');
            $table->index('ends_at');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
