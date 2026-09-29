<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'title',
        'booked_by',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    
    public function scopeUpcoming($query)
    {
        return $query->where('ends_at', '>', now());
    }
}
