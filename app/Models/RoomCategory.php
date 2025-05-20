<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Carbon\Carbon;
use App\Models\Room;

class RoomCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'capacity',
    ];

    // Assurez-vous que price est toujours un float
    protected $casts = [
        'price' => 'float',
        'capacity' => 'integer',
    ];

    /**
     * Get all rooms belonging to this category
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    /**
     * Get all available rooms belonging to this category
     */
    public function availableRooms(): HasMany
    {
        return $this->hasMany(Room::class)->where('is_available', true);
    }

    /**
     * Get all reservations for rooms in this category
     */
    public function reservations(): HasManyThrough
    {
        return $this->hasManyThrough(Reservation::class, Room::class);
    }

    /**
     * Récupère les chambres disponibles pour les dates spécifiées
     */
    public function getAvailableRoomsForDates($checkIn, $checkOut)
    {
        $rooms = $this->rooms()->where('is_available', true)->get();
        
        return $rooms->filter(function($room) use ($checkIn, $checkOut) {
            return $room->isAvailableForDates($checkIn, $checkOut);
        });
    }
    
    /**
     * Trouve la date la plus proche à laquelle une chambre sera disponible
     */
    public function getNextAvailableDate($checkIn, $checkOut)
    {
        // Si aucune chambre n'existe dans cette catégorie
        if ($this->rooms()->count() === 0) {
            return null;
        }
        
        // Obtenir toutes les réservations pour cette catégorie de chambre
        $reservations = Reservation::whereIn('room_id', $this->rooms()->pluck('id'))
                                  ->whereIn('status', ['pending', 'confirmed'])
                                  ->where('check_out_date', '>=', Carbon::parse($checkIn))
                                  ->orderBy('check_out_date')
                                  ->get();
                                  
        // Si aucune réservation, mais les chambres existent, alors elles sont disponibles maintenant
        if ($reservations->isEmpty()) {
            return Carbon::parse($checkIn);
        }
        
        // Chercher la première date où au moins une chambre est disponible
        $roomsCount = $this->rooms()->count();
        $currentDate = Carbon::parse($checkIn);
        $maxDate = Carbon::parse($checkIn)->addDays(60); // Limitation à 60 jours
        
        while ($currentDate->lte($maxDate)) {
            $occupiedRooms = 0;
            
            foreach ($reservations as $reservation) {
                $resCheckIn = Carbon::parse($reservation->check_in_date);
                $resCheckOut = Carbon::parse($reservation->check_out_date);
                
                if ($currentDate->between($resCheckIn, $resCheckOut->subDay())) {
                    $occupiedRooms++;
                }
            }
            
            // S'il y a au moins une chambre disponible
            if ($occupiedRooms < $roomsCount) {
                return $currentDate;
            }
            
            $currentDate->addDay();
        }
        
        return null; // Aucune disponibilité dans les 60 prochains jours
    }

    public function galleryImages()
    {
        return $this->hasMany(RoomCategoryImage::class)->orderBy('order');
    }

    public function images()
    {
        return $this->hasMany(RoomCategoryImage::class);
    }
    public function getAvailableRoomsCount(): int
    {
        return $this->rooms()->where('is_available', true)->count();
    }
}
