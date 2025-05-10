<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_category_id',
        'room_number',
        'is_available'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }
    
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
    
    /**
     * Vérifie si la chambre est disponible pour les dates données
     */
    public function isAvailableForDates($checkIn, $checkOut): bool
    {
        if (!$this->is_available) {
            return false;
        }
        
        return !$this->reservations()
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in_date', '<=', $checkOut)
                      ->where('check_out_date', '>=', $checkIn);
                })
                ->whereIn('status', ['pending', 'confirmed']);
            })
            ->exists();
    }
}
