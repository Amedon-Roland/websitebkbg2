@props([
    'latitude' => 6.16668,
    'longitude' => 1.33667,
    'zoom' => 15,
    'hotelName' => 'Hôtel BKBG',
    'address' => 'Quartier Baguida-Bateauvi, Bd du Mono, Lomé, Togo',
    'phone' => '+228 91415656',
    'email' => 'contact@hotelbkbg.com',
])

<div class="mt-8 mb-12">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b text-center border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Notre emplacement</h2>
                <p class="mt-1 text-gray-600">Venez nous retrouver à l'adresse suivante</p>
            </div>
            
            <div id="hotel-map" style="height: 500px; width: 100%;"></div>
            
            <div class="p-6 bg-gray-50">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex items-start space-x-4">
                        <div class="rounded-full bg-red-50 p-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Adresse</h3>
                            <p class="text-gray-600">{{ $address }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="rounded-full bg-red-50 p-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Téléphone</h3>
                            <p class="text-gray-600">{{ $phone }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="rounded-full bg-red-50 p-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Email</h3>
                            <p class="text-gray-600">{{ $email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    @endpush
@endonce

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Coordonnées de l'hôtel
            const hotelLat = {{ $latitude }};
            const hotelLng = {{ $longitude }};
            const hotelName = "{{ $hotelName }}";
            
            // Initialiser la carte
            const map = L.map('hotel-map').setView([hotelLat, hotelLng], {{ $zoom }});
            
            // Ajouter la couche de tuiles OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            // Ajouter un marqueur pour l'hôtel avec une popup
            const customIcon = L.divIcon({
                html: `<div class="flex items-center justify-center w-8 h-8 bg-red-600 rounded-full border-2 border-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                      </div>`,
                className: '',
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            });
            L.marker([hotelLat, hotelLng], {icon: customIcon})
                .addTo(map)
                .bindPopup(`
                    <div style="max-width: 220px; word-break: break-word;" class="text-center">
                        <div class="font-bold text-base mb-1">${hotelName}</div>
                        <div class="text-sm">${"{{ $address }}".replace(/\\n/g, '<br>')}</div>
                        <div class="text-sm mt-2 text-red-600">Bienvenue!</div>
                    </div>
                `, {
                    maxWidth: 240,
                    minWidth: 120,
                    className: 'leaflet-popup-content-responsive'
                })
                .openPopup();
        });
    </script>
@endpush