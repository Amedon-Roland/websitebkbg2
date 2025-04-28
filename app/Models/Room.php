<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'is_available',
        'capacity',
        'room_number'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'decimal:3',
    ];

    public function getAvailabilityTextAttribute()
    {
        return $this->is_available ? 'Available: Yes' : 'Available: No';
    }
}
