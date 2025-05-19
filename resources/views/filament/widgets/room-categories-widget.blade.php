<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold mb-4">Statistiques par catégorie</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 px-1">Catégorie</th>
                        <th class="text-right py-2 px-1">Prix</th>
                        <th class="text-center py-2 px-1">Chambres</th>
                        <th class="text-center py-2 px-1">Disponibles</th>
                        <th class="text-right py-2 px-1">Occupation</th>
                        <th class="text-right py-2 px-1">Réservations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->getCategories() as $category)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-1">{{ $category['name'] }}</td>
                            <td class="text-right py-2 px-1">{{ number_format($category['price'], 0, ',', ' ') }} FCFA</td>
                            <td class="text-center py-2 px-1">{{ $category['totalRooms'] }}</td>
                            <td class="text-center py-2 px-1">{{ $category['availableRooms'] }}</td>
                            <td class="text-right py-2 px-1">
                                <div class="flex items-center justify-end">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-primary rounded-full h-2" style="width: {{ $category['occupancyRate'] }}%"></div>
                                    </div>
                                    <span>{{ $category['occupancyRate'] }}%</span>
                                </div>
                            </td>
                            <td class="text-right py-2 px-1">{{ $category['reservations'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::card>
</x-filament::widget>