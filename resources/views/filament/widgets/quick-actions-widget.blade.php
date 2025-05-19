<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold mb-4">Actions rapides</h2>
        
        <div class="space-y-3">
            <a href="{{ route('filament.admin.resources.reservations.create') }}" class="inline-flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-lg hover:bg-primary-focus focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <span>Nouvelle réservation</span>
                <x-heroicon-o-plus-circle class="w-5 h-5" />
            </a>
            
            <a href="{{ route('filament.admin.resources.rooms.create') }}" class="inline-flex items-center justify-between w-full px-4 py-2 text-sm font-medium border rounded-lg text-primary hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <span>Ajouter une chambre</span>
                <x-heroicon-o-home class="w-5 h-5" />
            </a>
            
            <a href="{{ route('filament.admin.resources.room-categories.create') }}" class="inline-flex items-center justify-between w-full px-4 py-2 text-sm font-medium border rounded-lg text-primary hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <span>Ajouter une catégorie</span>
                <x-heroicon-o-tag class="w-5 h-5" />
            </a>
        </div>
    </x-filament::card>
</x-filament::widget>