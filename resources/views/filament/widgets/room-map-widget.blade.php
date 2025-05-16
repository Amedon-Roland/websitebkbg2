<x-filament::widget>
    <div class="card bg-base-100 shadow-xl overflow-hidden border border-base-200">
        <div class="card-body p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
                <h2 class="card-title text-base md:text-lg font-bold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Carte des chambres
                </h2>
                
                <!-- Légende -->
                <div class="flex flex-wrap items-center gap-3 text-xs">
                    <div class="flex items-center">
                        <div class="badge badge-success gap-1 font-normal">
                            <span class="w-2 h-2 rounded-full bg-success"></span>
                            Disponible
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="badge badge-error gap-1 font-normal">
                            <span class="w-2 h-2 rounded-full bg-error"></span>
                            Occupée
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filtres rapides -->
            <div class="join mb-4 flex-wrap justify-start">
                <button class="join-item btn btn-xs sm:btn-sm" aria-pressed="true">Toutes</button>
                <button class="join-item btn btn-xs sm:btn-sm btn-outline">Disponibles</button>
                <button class="join-item btn btn-xs sm:btn-sm btn-outline">Occupées</button>
            </div>
            
            <div class="divider my-2"></div>
            
            <div class="space-y-4">
                @foreach($this->getRooms() as $floor => $rooms)
                    <div class="card bg-base-200/50 hover:bg-base-200/80 transition-colors">
                        <div class="card-body p-3 md:p-4">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-2">
                                <h3 class="font-semibold text-sm flex items-center">
                                    <div class="badge badge-primary mr-2">{{ $floor }}</div>
                                    Étage {{ $floor }}
                                </h3>
                                
                                <!-- Statistiques par étage -->
                                <div class="flex flex-wrap gap-2 text-xs">
                                    <span class="badge badge-sm">
                                        {{ $rooms->count() }} chambre(s)
                                    </span>
                                    <span class="badge badge-sm badge-success">
                                        {{ $rooms->where('is_available', true)->count() }} disponible(s)
                                    </span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-8 gap-1.5 md:gap-2">
                                @foreach($rooms as $room)
                                    <div class="tooltip tooltip-top" data-tip="{{ $room->category->name }} - {{ number_format($room->category->price, 0, ',', ' ') }} FCFA">
                                        <div class="relative group cursor-pointer" aria-label="Chambre {{ $room->room_number }} - {{ $room->is_available ? 'Disponible' : 'Occupée' }}">
                                            <div class="absolute -inset-0.5 bg-gradient-to-r {{ $room->is_available ? 'from-green-500 to-emerald-600' : 'from-red-500 to-rose-600' }} rounded-lg blur opacity-25 group-hover:opacity-70 transition duration-300"></div>
                                            <div class="relative flex flex-col items-center justify-center aspect-square rounded-lg py-1 px-0.5 {{ $room->is_available ? 'bg-success/5 text-success-content border-success/30' : 'bg-error/5 text-error-content border-error/30' }} border overflow-hidden group-hover:bg-opacity-30 transition duration-200">
                                                <span class="font-bold text-sm md:text-base">{{ $room->room_number }}</span>
                                                <span class="text-[9px] md:text-[10px] opacity-80 truncate max-w-full px-1">{{ Str::limit($room->category->name, 12) }}</span>
                                                
                                                <div class="absolute bottom-0 left-0 right-0 h-1 {{ $room->is_available ? 'bg-success' : 'bg-error' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Résumé global -->
            <div class="mt-4 pt-4 border-t border-base-300 flex flex-col sm:flex-row gap-2 justify-between items-start sm:items-center">
                <div class="stats stats-vertical sm:stats-horizontal shadow-sm bg-base-200/50">
                    <div class="stat p-2">
                        <div class="stat-title text-xs">Total</div>
                        <div class="stat-value text-base">{{ $this->getTotalRoomsCount() }}</div>
                    </div>
                    <div class="stat p-2">
                        <div class="stat-title text-xs">Disponibles</div>
                        <div class="stat-value text-success text-base">{{ $this->getAvailableRoomsCount() }}</div>
                    </div>
                    <div class="stat p-2">
                        <div class="stat-title text-xs">Occupation</div>
                        <div class="stat-value text-error text-base">{{ $this->getOccupancyRate() }}%</div>
                    </div>
                </div>
                
                <button class="btn btn-sm btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Actualiser
                </button>
            </div>
        </div>
    </div>
</x-filament::widget>