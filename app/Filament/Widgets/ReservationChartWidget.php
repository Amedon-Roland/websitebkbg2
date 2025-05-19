<?php
namespace App\Filament\Widgets;

use App\Models\Reservation;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ReservationChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Réservations des 30 derniers jours';
    
    protected int|string|array $columnSpan = 2;
    
    protected static ?int $sort = 4;
    
    protected function getData(): array
    {
        $data = $this->getReservationsPerDay();
        
        return [
            'datasets' => [
                [
                    'label' => 'Réservations',
                    'data' => $data['counts'],
                    'backgroundColor' => 'rgba(175, 36, 28, 0.5)',
                    'borderColor' => 'rgb(175, 36, 28)',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $data['labels'],
        ];
    }
    
    protected function getType(): string
    {
        return 'line';
    }
    
    private function getReservationsPerDay(): array
    {
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        
        $dateRange = [];
        $currentDate = $startDate->copy();
        
        while ($currentDate <= $endDate) {
            $dateFormatted = $currentDate->format('Y-m-d');
            $dateRange[$dateFormatted] = 0;
            $currentDate->addDay();
        }
        
        $reservations = Reservation::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();
            
        foreach ($reservations as $date => $count) {
            if (isset($dateRange[$date])) {
                $dateRange[$date] = $count;
            }
        }
        
        return [
            'labels' => array_map(function ($date) {
                return Carbon::parse($date)->format('d/m');
            }, array_keys($dateRange)),
            'counts' => array_values($dateRange),
        ];
    }
}