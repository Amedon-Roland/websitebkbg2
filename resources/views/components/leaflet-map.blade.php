@props([
    'latitude' => 4.053333,
    'longitude' => 9.765556,
    'zoom' => 15,
    'hotelName' => 'Hôtel BKBG',
    'address' => 'Rue de Limbé, Douala, Cameroun',
    'phone' => '+237 123 456 789',
    'email' => 'contact@hotelbkbg.cm',
])

<div class="mt-8 mb-12">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
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
    // Fonction d'initialisation de la carte que nous pourrons réutiliser
    function initHotelMap() {
        // Coordonnées spécifiques à cette instance
        const hotelLat = {{ $latitude }};
        const hotelLng = {{ $longitude }};
        const hotelName = "{{ $hotelName }}";
        const hotelAddress = "{{ $address }}";
        const zoomLevel = {{ $zoom }};
        
        // S'assurer que l'élément existe
        const mapElement = document.getElementById('hotel-map');
        if (!mapElement) return;
        
        // Initialiser la carte
        const map = L.map('hotel-map').setView([hotelLat, hotelLng], zoomLevel);
        
        // Stocker la référence de la carte dans l'élément pour pouvoir la nettoyer plus tard
        mapElement._leafletMap = map;
        
        // Ajouter la couche de tuiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Créer un marqueur personnalisé
        const customIcon = L.divIcon({
            html: `<div style="background-color: #dc2626; color: white; width: 30px; height: 30px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    </svg>
                  </div>`,
            className: '',
            iconSize: [30, 30],
            iconAnchor: [15, 30],
            popupAnchor: [0, -30]
        });
        
        // Ajouter le marqueur et la popup
        L.marker([hotelLat, hotelLng], {icon: customIcon})
            .addTo(map)
            .bindPopup(`
                <div style="text-align: center; padding: 5px;">
                    <div style="font-weight: bold; margin-bottom: 5px;">${hotelName}</div>
                    <div style="font-size: 0.9em;">${hotelAddress}</div>
                    <div style="color: #dc2626; margin-top: 5px; font-size: 0.9em;">Bienvenue!</div>
                </div>
            `)
            .openPopup();
            
        // Invalidate size après initialisation pour éviter les problèmes d'affichage
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
        
        return map;
    }
    
    // Fonction pour nettoyer la carte existante
    function cleanupMap() {
        const mapElement = document.getElementById('hotel-map');
        if (mapElement && mapElement._leafletMap) {
            mapElement._leafletMap.remove();
            mapElement._leafletMap = null;
        }
    }
    
    // Initialiser la carte lors du chargement initial
    document.addEventListener('DOMContentLoaded', initHotelMap);
    
    // Nettoyage et réinitialisation lors de la navigation Livewire
    document.addEventListener('livewire:navigating', cleanupMap);
    document.addEventListener('livewire:navigated', function() {
        // Vérifier si nous sommes sur une page avec une carte
        if (document.getElementById('hotel-map')) {
            // Petite temporisation pour s'assurer que le DOM est stable
            setTimeout(initHotelMap, 100);
        }
    });
</script>
@endpush