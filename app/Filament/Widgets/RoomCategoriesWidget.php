<?php

namespace App\Filament\Widgets;

use App\Models\RoomCategory;
use Filament\Widgets\Widget;

class RoomCategoriesWidget extends Widget
{
    protected static string $view = 'filament.widgets.room-categories-widget';
    
    protected int|string|array $columnSpan = 2;
    
    protected static ?int $sort = 5;
    
    public function getCategories()
    {
        return RoomCategory::withCount(['rooms'])
            ->get()
            ->map(function ($category) {
                $totalRooms = $category->rooms_count;
                
                // Compter manuellement les chambres disponibles
                $availableRooms = $category->rooms()->where('is_available', true)->count();
                
                $occupancyRate = $totalRooms > 0 
                    ? round(100 - (($availableRooms / $totalRooms) * 100), 1) 
                    : 0;
                
                // Compter les réservations si la relation existe, sinon utiliser 0
                $reservationCount = method_exists($category, 'reservations') 
                    ? $category->reservations()->count() 
                    : 0;
                
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'price' => $category->price,
                    'totalRooms' => $totalRooms,
                    'availableRooms' => $availableRooms,
                    'occupancyRate' => $occupancyRate,
                    'reservations' => $reservationCount,
                ];
            });
    }
}