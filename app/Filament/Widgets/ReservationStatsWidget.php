<?php
namespace App\Filament\Widgets;

use App\Models\Reservation;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservationStatsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected function getStats(): array
    {
        $today = Carbon::today();
        
        // Réservations du jour
        $todayCheckIns = Reservation::whereDate('check_in_date', $today)->count();
        $todayCheckOuts = Reservation::whereDate('check_out_date', $today)->count();
        
        // Réservations à venir (7 prochains jours)
        $upcomingReservations = Reservation::whereBetween('check_in_date', [
            $today->copy()->addDay(), 
            $today->copy()->addDays(7)
        ])->count();
        
        // Revenus du mois
        $monthlyRevenue = Reservation::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->sum('total_price');
        
        return [
            Stat::make('Arrivées aujourd\'hui', $todayCheckIns)
                ->description('Check-ins pour aujourd\'hui')
                ->descriptionIcon('heroicon-o-arrow-right-on-rectangle') // Anciennement 'heroicon-o-login'
                ->color('primary'),
                
            Stat::make('Départs aujourd\'hui', $todayCheckOuts)
                ->description('Check-outs pour aujourd\'hui')
                ->descriptionIcon('heroicon-o-arrow-left-on-rectangle') // Anciennement 'heroicon-o-logout'
                ->color('warning'),
                
            Stat::make('Réservations à venir', $upcomingReservations)
                ->description('Dans les 7 prochains jours')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('success'),
                
            Stat::make('Revenus du mois', number_format($monthlyRevenue, 0, ',', ' ') . ' FCFA')
                ->description('Pour le mois en cours')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),
        ];
    }
}