<?php

namespace App\Observers;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;

class ReservationObserver
{
    /**
     * Gérer l'événement "created" ou "updated" d'une réservation.
     */
    public function saved(Reservation $reservation): void
    {
        $this->updateRoomAvailability($reservation);
    }

    /**
     * Gérer l'événement "deleted" d'une réservation.
     */
    public function deleted(Reservation $reservation): void
    {
        // Vérifier s'il existe d'autres réservations pour cette chambre
        $this->checkAndUpdateRoomAvailability($reservation->room_id);
    }

    /**
     * Mettre à jour la disponibilité de la chambre en fonction du statut et de la date de réservation
     */
    private function updateRoomAvailability(Reservation $reservation): void
    {
        if (!$reservation->room_id || $reservation->status === 'cancelled') {
            // Si la réservation est annulée, vérifier s'il y a d'autres réservations
            if ($reservation->room_id) {
                $this->checkAndUpdateRoomAvailability($reservation->room_id);
            }
            return;
        }

        $today = Carbon::today();
        $checkInMinus1Day = Carbon::parse($reservation->check_in_date)->subDay();
        
        // La chambre devient indisponible si:
        // 1. La réservation n'est pas annulée ET
        // 2. Nous sommes à J-1 du check-in ou après
        if ($today->greaterThanOrEqualTo($checkInMinus1Day)) {
            Room::where('id', $reservation->room_id)->update(['is_available' => false]);
        }
    }
    
    /**
     * Vérifier s'il existe des réservations imminentes pour cette chambre
     */
    private function checkAndUpdateRoomAvailability(int $roomId): void
    {
        $today = Carbon::today();
        
        // Chercher des réservations actives à J-1 ou moins
        $imminentReservations = Reservation::where('room_id', $roomId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($today) {
                $query->whereDate('check_in_date', '<=', $today->copy()->addDay())
                      ->whereDate('check_out_date', '>', $today);
            })
            ->exists();
            
        // Si aucune réservation imminente, rendre la chambre disponible
        if (!$imminentReservations) {
            Room::where('id', $roomId)->update(['is_available' => true]);
        }
    }
}