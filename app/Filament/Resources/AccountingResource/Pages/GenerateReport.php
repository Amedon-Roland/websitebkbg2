<?php

namespace App\Filament\Resources\AccountingResource\Pages;

use App\Filament\Resources\AccountingResource;
use App\Models\Reservation;
use App\Models\RoomCategory;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Notifications;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Computed;

class GenerateReport extends Page
{
    protected static string $resource = AccountingResource::class;

    protected static string $view = 'filament.resources.accounting-resource.pages.generate-report';

    public ?array $data = [];
    
    public array $reportData = [];
    
    public bool $isReportGenerated = false;
    
    public bool $isGenerating = false;

    public function mount(): void
    {
        $this->form->fill([
            'start_date' => Carbon::now()->startOfMonth()->format('Y-m-d'),
            'end_date' => Carbon::now()->endOfMonth()->format('Y-m-d'),
            'status' => 'confirmed',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Paramètres du rapport')
                    ->description('Sélectionnez la période et les statuts de réservation à inclure')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->collapsible()
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DatePicker::make('start_date')
                                    ->label('Date de début')
                                    ->required()
                                    ->default(Carbon::now()->startOfMonth())
                                    ->displayFormat('d/m/Y')
                                    ->prefixIcon('heroicon-o-calendar') // Au lieu de icon()
                                    ->closeOnDateSelection(),
                                    
                                DatePicker::make('end_date')
                                    ->label('Date de fin')
                                    ->required()
                                    ->default(Carbon::now()->endOfMonth())
                                    ->displayFormat('d/m/Y')
                                    ->prefixIcon('heroicon-o-calendar') // Au lieu de icon()
                                    ->closeOnDateSelection(),
                                    
                                Select::make('status')
                                    ->label('Statut des réservations')
                                    ->options([
                                        'all' => 'Toutes les réservations',
                                        'confirmed' => 'Confirmées uniquement',
                                        'completed' => 'Terminées uniquement',
                                        'pending' => 'En attente uniquement',
                                        'cancelled' => 'Annulées uniquement',
                                    ])
                                    ->default('confirmed')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->prefixIcon('heroicon-o-funnel'), // Au lieu de icon()
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function generateReport()
    {
        $this->isGenerating = true;
        
        try {
            $this->reportData = $this->calculateReportData();
            $this->isReportGenerated = true;
            
            Notifications\Notification::make()
                ->title('Rapport généré avec succès!')
                ->body('Vos données sont prêtes à être consultées ou téléchargées.')
                ->success()
                ->icon('heroicon-o-check-circle')
                ->iconColor('success')
                ->duration(5000)
                ->send();
        } catch (Halt $exception) {
            Notifications\Notification::make()
                ->title('Erreur lors de la génération du rapport')
                ->body('Veuillez vérifier les paramètres et réessayer.')
                ->danger()
                ->icon('heroicon-o-x-circle')
                ->duration(5000)
                ->send();
        } finally {
            $this->isGenerating = false;
        }
    }
    
    public function downloadPdf()
    {
        if (!$this->isReportGenerated) {
            $this->reportData = $this->calculateReportData();
        }
        
        $startDate = Carbon::parse($this->data['start_date'])->format('d/m/Y');
        $endDate = Carbon::parse($this->data['end_date'])->format('d/m/Y');
        
        // Nettoyer le nom de fichier en remplaçant les caractères non autorisés
        $cleanStartDate = str_replace('/', '-', $startDate);
        $cleanEndDate = str_replace('/', '-', $endDate);
        
        Notifications\Notification::make()
            ->title('Préparation du PDF en cours...')
            ->info()
            ->icon('heroicon-o-document-arrow-down')
            ->send();
        
        $pdf = Pdf::loadView('pdfs.accounting-report', [
            'reportData' => $this->reportData,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'generatedAt' => Carbon::now()->format('d/m/Y H:i'),
        ]);
        
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "rapport-comptabilite-{$cleanStartDate}-{$cleanEndDate}.pdf"
        );
    }
    
    #[Computed]
    public function getRevenueGrowth()
    {
        if (empty($this->reportData) || $this->reportData['total_revenue'] == 0) {
            return 0;
        }
        
        // Calculer la période précédente
        $startDate = Carbon::parse($this->data['start_date']);
        $endDate = Carbon::parse($this->data['end_date']);
        $daysDiff = $startDate->diffInDays($endDate);
        
        $previousStartDate = $startDate->copy()->subDays($daysDiff + 1);
        $previousEndDate = $startDate->copy()->subDay();
        
        // Récupérer les données de la période précédente
        $previousReservationsQuery = Reservation::whereBetween('check_in_date', [$previousStartDate, $previousEndDate])
            ->orWhereBetween('check_out_date', [$previousStartDate, $previousEndDate])
            ->orWhere(function ($query) use ($previousStartDate, $previousEndDate) {
                $query->where('check_in_date', '<', $previousStartDate)
                      ->where('check_out_date', '>', $previousEndDate);
            });
            
        if ($this->data['status'] !== 'all') {
            $previousReservationsQuery->where('status', $this->data['status']);
        } else {
            $previousReservationsQuery->whereIn('status', ['pending', 'confirmed', 'completed']);
        }
        
        $previousRevenue = $previousReservationsQuery->sum('total_price');
        
        if ($previousRevenue == 0) {
            return 100; // Si aucun revenu précédent, considérer comme 100% de croissance
        }
        
        return round((($this->reportData['total_revenue'] - $previousRevenue) / $previousRevenue) * 100, 1);
    }
    
    private function calculateReportData(): array
    {
        // Code existant pour calculer les données du rapport...
        $startDate = Carbon::parse($this->data['start_date']);
        $endDate = Carbon::parse($this->data['end_date']);
        $status = $this->data['status'];
        
        // Requête de base pour les réservations dans la période
        $reservationsQuery = Reservation::whereBetween('check_in_date', [$startDate, $endDate])
            ->orWhereBetween('check_out_date', [$startDate, $endDate])
            ->orWhere(function ($query) use ($startDate, $endDate) {
                $query->where('check_in_date', '<', $startDate)
                      ->where('check_out_date', '>', $endDate);
            });
            
        // Filtrer par statut si différent de "all"
        if ($status !== 'all') {
            $reservationsQuery->where('status', $status);
        } else {
            $reservationsQuery->whereIn('status', ['pending', 'confirmed', 'completed']);
        }
        
        $reservations = $reservationsQuery->get();
        
        // Statistiques globales
        $totalRevenue = $reservations->sum('total_price');
        $totalReservations = $reservations->count();
        $totalNights = 0;
        $averageRevenuePerReservation = $totalReservations > 0 ? $totalRevenue / $totalReservations : 0;
        
        // Statistiques par catégories de chambre
        $categoriesStats = [];
        $categories = RoomCategory::all();
        
        foreach ($categories as $category) {
            $categoryReservations = $reservations->where('room_category_id', $category->id);
            $categoryRevenue = $categoryReservations->sum('total_price');
            $categoryCount = $categoryReservations->count();
            
            if ($categoryCount > 0) {
                $categoriesStats[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'reservations_count' => $categoryCount,
                    'revenue' => $categoryRevenue,
                    'percentage' => $totalRevenue > 0 ? ($categoryRevenue / $totalRevenue) * 100 : 0,
                ];
            }
        }
        
        // Statistiques par services additionnels
        $servicesStats = [
            'breakfast' => [
                'name' => 'Petit-déjeuner',
                'count' => $reservations->where('breakfast', true)->count(),
                'revenue' => $reservations->where('breakfast', true)->count() * 5000,
                'icon' => 'heroicon-o-cake',
            ],
            'pets' => [
                'name' => 'Animaux',
                'count' => $reservations->where('pets', true)->count(),
                'revenue' => $reservations->where('pets', true)->count() * 5000,
                'icon' => 'heroicon-o-heart',
            ],
            'airport_transfer' => [
                'name' => 'Transfert aéroport',
                'count' => $reservations->where('airport_transfer', true)->count(),
                'revenue' => $reservations->where('airport_transfer', true)->count() * 10000,
                'icon' => 'heroicon-o-truck',
            ],
        ];
        
        // Statistiques par méthode de paiement
        $paymentMethodsStats = $reservations
            ->groupBy('payment_method')
            ->map(function ($items, $method) {
                return [
                    'method' => match($method) {
                        'credit_card' => 'Carte de crédit',
                        'bank_transfer' => 'Virement bancaire',
                        'cash' => 'Espèces',
                        default => 'Autre',
                    },
                    'count' => $items->count(),
                    'revenue' => $items->sum('total_price'),
                    'icon' => match($method) {
                        'credit_card' => 'heroicon-o-credit-card',
                        'bank_transfer' => 'heroicon-o-building-library',
                        'cash' => 'heroicon-o-banknotes',
                        default => 'heroicon-o-wallet',
                    }, 
                ];
            })
            ->values()
            ->toArray();
        
        // Répartition par jour
        $dailyRevenueData = [];
        $currentDate = $startDate->copy();
        
        while ($currentDate <= $endDate) {
            $dateString = $currentDate->format('Y-m-d');
            
            // Réservations dont la période inclut cette date
            $dailyReservations = $reservations->filter(function ($reservation) use ($currentDate) {
                return $reservation->check_in_date <= $currentDate && $reservation->check_out_date > $currentDate;
            });
            
            // Calculer le revenu quotidien
            $dailyRevenue = 0;
            foreach ($dailyReservations as $reservation) {
                $totalDays = $reservation->check_in_date->diffInDays($reservation->check_out_date);
                if ($totalDays > 0) {
                    $dailyRevenue += $reservation->total_price / $totalDays;
                }
                $totalNights++;
            }
            
            $dailyRevenueData[] = [
                'date' => $currentDate->format('d/m/Y'),
                'revenue' => round($dailyRevenue),
                'reservations' => $dailyReservations->count(),
                'is_weekend' => in_array($currentDate->dayOfWeek, [0, 6]), // 0 = dimanche, 6 = samedi
            ];
            
            $currentDate->addDay();
        }
        
        // Ajouter les données pour générer un sparkline du revenu quotidien
        $sparklineData = array_map(function ($day) {
            return $day['revenue'];
        }, $dailyRevenueData);
        
        return [
            'total_revenue' => $totalRevenue,
            'total_reservations' => $totalReservations,
            'total_nights' => $totalNights,
            'average_revenue_per_reservation' => $averageRevenuePerReservation,
            'start_date' => $startDate->format('d/m/Y'),
            'end_date' => $endDate->format('d/m/Y'),
            'categories_stats' => $categoriesStats,
            'services_stats' => $servicesStats,
            'payment_methods_stats' => $paymentMethodsStats,
            'daily_revenue' => $dailyRevenueData,
            'sparkline_data' => $sparklineData,
        ];
    }
}