<x-filament-panels::page>
    <div class="space-y-6">
        <!-- En-tête et description -->
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Rapport Comptable</h1>
            <p class="mt-1 text-gray-500 dark:text-gray-400">
                Générez des rapports financiers détaillés sur vos réservations par période.
            </p>
        </div>
    
        <!-- Formulaire avec animation d'état de chargement -->
        <div x-data="{ submitting: false }" class="relative">
            <div x-show="submitting" class="absolute inset-0 bg-white/50 dark:bg-gray-900/50 z-10 flex items-center justify-center rounded-lg">
                <div class="flex flex-col items-center space-y-2">
                    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div>
                    <span class="text-primary font-semibold">Génération en cours...</span>
                </div>
            </div>
            
            <form wire:submit="generateReport" @submit="submitting = true" @submit.prevent="$wire.generateReport().then(() => { submitting = false })">
                {{ $this->form }}
    
                <div class="mt-4 flex flex-wrap justify-end gap-3">
                    
                    
                    <x-filament::button 
                        type="submit"
                        icon="heroicon-o-chart-bar"
                        wire:loading.attr="disabled"
                    >
                        Générer le rapport
                    </x-filament::button>
                </div>
            </form>
        </div>
    
        <!-- Affichage du rapport -->
        @if($isReportGenerated)
            <div class="mt-8 animate-fadeIn">
                <!-- En-tête du rapport avec actions -->
                <div class="mb-6 flex flex-wrap justify-between items-center gap-4">
                    <div class="space-y-1">
                        <h2 class="text-xl font-bold flex items-center space-x-2">
                            <span class="inline-flex items-center justify-center p-2 bg-primary/10 text-primary rounded-lg">
                                <x-heroicon-o-document-chart-bar class="h-5 w-5" />
                            </span>
                            <span>Rapport du {{ $reportData['start_date'] }} au {{ $reportData['end_date'] }}</span>
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $reportData['total_reservations'] }} réservation(s) sur {{ count($reportData['daily_revenue']) }} jour(s)
                        </p>
                    </div>
                    
                    <div class="flex flex-wrap gap-2">
                        <x-filament::button 
                            wire:click="downloadPdf"
                            color="success"
                            icon="heroicon-o-arrow-down-tray"
                            wire:loading.attr="disabled"
                        >
                            Télécharger en PDF
                        </x-filament::button>
                    </div>
                </div>
    
                <!-- Statistiques Générales avec cartes modernes -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center space-x-4 hover:shadow-md transition-shadow">
                        <div class="rounded-full bg-primary/10 p-3 flex-shrink-0">
                            <x-heroicon-o-banknotes class="h-6 w-6 text-primary" />
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Revenu Total</div>
                            <div class="text-2xl font-bold text-primary">{{ number_format($reportData['total_revenue'], 0, ',', ' ') }} <span class="text-sm">FCFA</span></div>
                            
                            @if($this->getRevenueGrowth() != 0)
                                <div class="mt-1 flex items-center text-xs font-medium {{ $this->getRevenueGrowth() > 0 ? 'text-success' : 'text-danger' }}">
                                    <span class="flex-shrink-0">
                                        @if($this->getRevenueGrowth() > 0)
                                            <x-heroicon-s-arrow-trending-up class="h-3 w-3 mr-1 inline" />
                                            +{{ $this->getRevenueGrowth() }}%
                                        @else
                                            <x-heroicon-s-arrow-trending-down class="h-3 w-3 mr-1 inline" />
                                            {{ $this->getRevenueGrowth() }}%
                                        @endif
                                    </span>
                                    <span>vs période précédente</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center space-x-4 hover:shadow-md transition-shadow">
                        <div class="rounded-full bg-secondary/10 p-3 flex-shrink-0">
                            <x-heroicon-o-clipboard-document-check class="h-6 w-6 text-secondary" />
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Réservations</div>
                            <div class="text-2xl font-bold text-secondary">{{ $reportData['total_reservations'] }}</div>
                            <div class="text-xs text-gray-500 mt-1">Durant la période</div>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center space-x-4 hover:shadow-md transition-shadow">
                        <div class="rounded-full bg-success/10 p-3 flex-shrink-0">
                            <x-heroicon-o-calendar-days class="h-6 w-6 text-success" />
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Nuitées</div>
                            <div class="text-2xl font-bold text-success">{{ $reportData['total_nights'] }}</div>
                            <div class="text-xs text-gray-500 mt-1">Total occupé</div>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center space-x-4 hover:shadow-md transition-shadow">
                        <div class="rounded-full bg-warning/10 p-3 flex-shrink-0">
                            <x-heroicon-o-chart-bar class="h-6 w-6 text-warning" />
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Revenu Moyen</div>
                            <div class="text-2xl font-bold text-warning">{{ number_format($reportData['average_revenue_per_reservation'], 0, ',', ' ') }} <span class="text-sm">FCFA</span></div>
                            <div class="text-xs text-gray-500 mt-1">Par réservation</div>
                        </div>
                    </div>
                </div>
    
                <!-- Utilisation des sections au lieu des onglets pour plus de fiabilité -->
                <div class="space-y-6">
                    <!-- Catégories de chambres -->
                    <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2 mb-4">
                            <x-heroicon-o-home class="h-5 w-5 text-primary" />
                            <h3 class="text-lg font-medium">Répartition par catégorie de chambre</h3>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="py-2 px-4 text-left">Catégorie</th>
                                        <th class="py-2 px-4 text-right">Réservations</th>
                                        <th class="py-2 px-4 text-right">Revenu</th>
                                        <th class="py-2 px-4 text-right">% du revenu</th>
                                        <th class="py-2 px-4 text-left">Graphique</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reportData['categories_stats'] as $category)
                                        <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/20">
                                            <td class="py-3 px-4 font-medium">{{ $category['name'] }}</td>
                                            <td class="py-3 px-4 text-right">{{ $category['reservations_count'] }}</td>
                                            <td class="py-3 px-4 text-right font-semibold">{{ number_format($category['revenue'], 0, ',', ' ') }} FCFA</td>
                                            <td class="py-3 px-4 text-right">{{ number_format($category['percentage'], 1) }}%</td>
                                            <td class="py-3 px-4">
                                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                                    <div class="bg-primary h-2.5 rounded-full" style="width: {{ min(100, $category['percentage']) }}%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Services additionnels -->
                    <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2 mb-4">
                            <x-heroicon-o-sparkles class="h-5 w-5 text-primary" />
                            <h3 class="text-lg font-medium">Services additionnels</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($reportData['services_stats'] as $service)
                                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 flex items-center space-x-4">
                                    <div class="rounded-full bg-primary/10 p-3">
                                        @if(isset($service['icon']))
                                            <x-dynamic-component :component="'heroicon-o-' . str_replace('heroicon-o-', '', $service['icon'])" class="h-6 w-6 text-primary" />
                                        @else
                                            <x-heroicon-o-sparkles class="h-6 w-6 text-primary" />
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-medium">{{ $service['name'] }}</div>
                                        <div class="text-2xl font-bold">{{ number_format($service['revenue'], 0, ',', ' ') }} <span class="text-sm">FCFA</span></div>
                                        <div class="text-sm text-gray-500">{{ $service['count'] }} réservation(s)</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Modes de paiement -->
                    <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2 mb-4">
                            <x-heroicon-o-credit-card class="h-5 w-5 text-primary" />
                            <h3 class="text-lg font-medium">Modes de paiement</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th class="py-2 px-4 text-left">Méthode</th>
                                            <th class="py-2 px-4 text-right">Réservations</th>
                                            <th class="py-2 px-4 text-right">Revenu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reportData['payment_methods_stats'] as $method)
                                            <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/20">
                                                <td class="py-3 px-4">
                                                    <div class="flex items-center">
                                                        @if(isset($method['icon']))
                                                            <x-dynamic-component :component="'heroicon-o-' . str_replace('heroicon-o-', '', $method['icon'])" class="h-5 w-5 mr-2 text-primary" />
                                                        @endif
                                                        {{ $method['method'] }}
                                                    </div>
                                                </td>
                                                <td class="py-3 px-4 text-right">{{ $method['count'] }}</td>
                                                <td class="py-3 px-4 text-right font-semibold">{{ number_format($method['revenue'], 0, ',', ' ') }} FCFA</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-gray-500 mb-3">Répartition des paiements</h4>
                                
                                <!-- Graphique de répartition simplifié -->
                                <div class="space-y-3">
                                    @foreach($reportData['payment_methods_stats'] as $method)
                                        @php 
                                            $percentage = $reportData['total_revenue'] > 0 
                                                ? ($method['revenue'] / $reportData['total_revenue']) * 100 
                                                : 0;
                                        @endphp
                                        <div class="space-y-1">
                                            <div class="flex justify-between items-center text-xs">
                                                <span>{{ $method['method'] }}</span>
                                                <span>{{ number_format($percentage, 1) }}%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                <div class="bg-primary h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Revenus par jour -->
                    <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2 mb-4">
                            <x-heroicon-o-calendar class="h-5 w-5 text-primary" />
                            <h3 class="text-lg font-medium">Revenus par jour</h3>
                        </div>
                        
                        <!-- Visualisation des revenus quotidiens -->
                        <div class="mb-6 h-20 bg-gray-50 dark:bg-gray-900/30 rounded-lg p-2">
                            <!-- Afficher un mini-graphique simple des revenus quotidiens -->
                            <div class="flex items-end justify-between h-full w-full">
                                @foreach($reportData['daily_revenue'] as $day)
                                    @php
                                        $maxRevenue = max(array_column($reportData['daily_revenue'], 'revenue'));
                                        $height = $maxRevenue > 0 ? ($day['revenue'] / $maxRevenue) * 100 : 0;
                                    @endphp
                                    <div 
                                        class="group relative h-full flex flex-col justify-end"
                                        style="width: calc(100% / {{ count($reportData['daily_revenue']) }})"
                                    >
                                        <div 
                                            class="{{ $day['is_weekend'] ? 'bg-primary/50' : 'bg-primary' }} rounded-t-sm w-full transition-all hover:opacity-80"
                                            style="height: {{ max(5, $height) }}%"
                                        ></div>
                                        
                                        <!-- Tooltip hover -->
                                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block z-10">
                                            <div class="bg-gray-800 text-white text-xs rounded py-1 px-2 whitespace-nowrap">
                                                {{ $day['date'] }}: {{ number_format($day['revenue'], 0, ',', ' ') }} FCFA
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="py-2 px-4 text-left">Date</th>
                                        <th class="py-2 px-4 text-right">Réservations</th>
                                        <th class="py-2 px-4 text-right">Revenu estimé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reportData['daily_revenue'] as $day)
                                        <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/20 {{ $day['is_weekend'] ? 'bg-gray-50 dark:bg-gray-900/20' : '' }}">
                                            <td class="py-3 px-4 {{ $day['is_weekend'] ? 'font-medium' : '' }}">{{ $day['date'] }}</td>
                                            <td class="py-3 px-4 text-right">{{ $day['reservations'] }}</td>
                                            <td class="py-3 px-4 text-right font-semibold">{{ number_format($day['revenue'], 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</x-filament-panels::page>

