<?php

namespace App\Filament\Widgets;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Reservation;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RoomAvailabilityWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        // Date du jour
        $today = Carbon::today();
        
        // Récupérer toutes les chambres
        $totalRooms = Room::count();
        
        // Récupérer les IDs des chambres actuellement réservées
        $reservedRoomIds = Reservation::where(function($query) use ($today) {
            $query->where('check_in_date', '<=', $today)
                  ->where('check_out_date', '>', $today)
                  ->where('status', '!=', 'cancelled');
        })->pluck('room_id')->toArray();
        
        // Chambres techniquement disponibles (selon le champ is_available)
        $technicallyAvailable = Room::where('is_available', true)->count();
        
        // Chambres réellement disponibles (disponibles ET non réservées)
        $actuallyAvailable = Room::where('is_available', true)
                               ->whereNotIn('id', $reservedRoomIds)
                               ->count();
        
        // Chambres réservées mais marquées comme disponibles (incohérence)
        $inconsistentRooms = Room::where('is_available', true)
                               ->whereIn('id', $reservedRoomIds)
                               ->count();
        
        // Taux d'occupation réel
        $occupancyRate = $totalRooms > 0 
            ? round(100 - (($actuallyAvailable / $totalRooms) * 100), 1) 
            : 0;
            
        // Statistiques par catégorie
        $categories = RoomCategory::withCount(['rooms'])->get();
        
        foreach($categories as $category) {
            // Compter les chambres réellement disponibles par catégorie
            $category->available_rooms_count = $category->rooms()
                ->where('is_available', true)
                ->whereNotIn('id', $reservedRoomIds)
                ->count();
        }
        
        $stats = [
            Stat::make('Chambres totales', $totalRooms)
                ->description('Nombre total de chambres')
                ->descriptionIcon('heroicon-o-home')
                ->color('primary'),
                
            Stat::make('Chambres disponibles', $actuallyAvailable)
                ->description("{$occupancyRate}% d'occupation réelle")
                ->descriptionIcon('heroicon-o-check-circle')
                ->color($actuallyAvailable > 0 ? 'success' : 'danger'),
                
            Stat::make('Taux d\'occupation', "{$occupancyRate}%")
                ->description('Pour toutes les chambres')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('warning'),
        ];
        
        // Ajouter une alerte si des incohérences sont détectées
        if ($inconsistentRooms > 0) {
            $stats[] = Stat::make('Attention', "{$inconsistentRooms} chambre(s)")
                ->description('Réservées mais marquées disponibles')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('danger');
        }
        
        return $stats;
    }
}