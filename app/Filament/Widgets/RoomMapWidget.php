<?php
namespace App\Filament\Widgets;

use App\Models\Room;
use Filament\Widgets\Widget;

class RoomMapWidget extends Widget
{
    protected static string $view = 'filament.widgets.room-map-widget';
    
    protected int|string|array $columnSpan = 2;
    
    public function getRooms()
    {
        return Room::with('category')
            ->orderBy('room_number')
            ->get()
            ->groupBy(function ($room) {
                // Grouper par étage (premier chiffre du numéro de chambre)
                return substr($room->room_number, 0, 1);
            });
    }
    
    public function getTotalRoomsCount()
    {
        return Room::count();
    }

    public function getAvailableRoomsCount()
    {
        return Room::where('is_available', true)->count();
    }

    public function getOccupancyRate()
    {
        $total = $this->getTotalRoomsCount();
        if ($total === 0) return 0;
        
        $available = $this->getAvailableRoomsCount();
        return round(100 - (($available / $total) * 100));
    }
}