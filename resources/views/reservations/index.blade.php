@extends('layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800">Réservez votre séjour</h1>
            <p class="text-lg text-gray-600 mt-2">Complétez vos informations pour finaliser votre réservation</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded-lg p-6">
<form action="{{ route('reservations.create') }}" method="POST">
    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Informations de la chambre -->
                        <div class="md:col-span-2 border-b pb-4 mb-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Détails de votre séjour</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Type de chambre -->
                                <div>
                                    <label for="room_category_id" class="block text-sm font-medium text-gray-700 mb-1">Type de chambre</label>
                                    <select id="room_category_id" name="room_category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                        @foreach($roomCategories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ (request()->input('room_category_id') == $category->id || 
                                                   (isset($preselectedCategory) && $preselectedCategory->id == $category->id)) ? 'selected' : '' }}>
                                                {{ $category->name }} - {{ number_format($category->price, 0, ',', ' ') }} FCFA
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Ajoutez après le sélecteur de type de chambre -->
                                <div class="mt-3" id="room-category-details" style="display: none;">
                                    <div class="p-4 bg-gray-50 rounded-md">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="font-semibold text-primary room-category-name"></span>
                                            <span class="font-bold text-secondary room-category-price"></span>
                                        </div>
                                        <p class="text-sm text-gray-600 room-category-description"></p>
                                    </div>
                                </div>
                                
                                <!-- Nombre de personnes -->
                                <div>
                                    <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Nombre de personnes</label>
                                    <select id="guests" name="guests" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ request()->input('guests') == $i ? 'selected' : '' }}>
                                                {{ $i }} {{ $i > 1 ? 'personnes' : 'personne' }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                
                                <!-- Date d'arrivée -->
                                <div>
                                    <label for="check_in_date" class="block text-sm font-medium text-gray-700 mb-1">Date d'arrivée</label>
                                    <input type="date" id="check_in_date" name="check_in_date" 
                                        value="{{ request()->input('check_in_date') ?: date('Y-m-d') }}" 
                                        min="{{ date('Y-m-d') }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                                
                                <!-- Date de départ -->
                                <div>
                                    <label for="check_out_date" class="block text-sm font-medium text-gray-700 mb-1">Date de départ</label>
                                    <input type="date" id="check_out_date" name="check_out_date" 
                                        value="{{ request()->input('check_out_date') ?: date('Y-m-d', strtotime('+1 day')) }}" 
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Coordonnées personnelles -->
                        <div class="md:col-span-2 border-b pb-4 mb-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informations personnelles</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Civilité -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Civilité</label>
                                    <select id="title" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                        <option value="">Sélectionnez</option>
                                        <option value="M.">Monsieur</option>
                                        <option value="Mme">Madame</option>
                                        <option value="Mlle">Mademoiselle</option>
                                    </select>
                                </div>
                                
                                <!-- Nom -->
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                    <input type="text" id="last_name" name="last_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                                
                                <!-- Prénom -->
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                                    <input type="text" id="first_name" name="first_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                                
                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                                
                                <!-- Téléphone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                    <input type="tel" id="phone" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                                
                                <!-- Adresse -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                                    <input type="text" id="address" name="address" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Préférences et demandes -->
                        <div class="md:col-span-2">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Préférences et demandes spéciales</h2>
                            
                            <div>
                                <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-1">Demandes spéciales</label>
                                <textarea id="special_requests" name="special_requests" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" placeholder="Ex: chambre avec vue, lit bébé, etc..."></textarea>
                            </div>
                            
                            <!-- Options supplémentaires -->
                            <div class="mt-4">
                                <p class="block text-sm font-medium text-gray-700 mb-2">Options supplémentaires</p>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="breakfast" class="rounded text-primary border-gray-300 focus:ring-primary/50">
                                        <span class="ml-2 text-sm text-gray-700">Petit-déjeuner (supplément)</span>
                                    </label>
                                    
                                    <label class="flex items-center">
                                        <input type="checkbox" name="late_checkout" class="rounded text-primary border-gray-300 focus:ring-primary/50">
                                        <span class="ml-2 text-sm text-gray-700">Départ tardif (selon disponibilité)</span>
                                    </label>
                                    
                                    <label class="flex items-center">
                                        <input type="checkbox" name="airport_transfer" class="rounded text-primary border-gray-300 focus:ring-primary/50">
                                        <span class="ml-2 text-sm text-gray-700">Transfert aéroport (supplément)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Termes et conditions -->
                        <div class="md:col-span-2 mt-4">
                            <label class="flex items-start">
                                <input type="checkbox" name="terms_accepted" class="rounded text-primary border-gray-300 focus:ring-primary/50 mt-1" required>
                                <span class="ml-2 text-sm text-gray-700">
                                    J'accepte les <a href="#" class="text-primary hover:underline">termes et conditions</a> et la <a href="#" class="text-primary hover:underline">politique de confidentialité</a>
                                </span>
                            </label>
                            @error('terms_accepted')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-md shadow-md hover:bg-primary/90 transition">
                            Continuer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = document.getElementById('check_in_date');
        const checkOutInput = document.getElementById('check_out_date');
        
        // Ensure check-out date is after check-in date
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            const nextDay = new Date(checkInDate);
            nextDay.setDate(nextDay.getDate() + 1);
            
            // Format the date as YYYY-MM-DD
            const year = nextDay.getFullYear();
            const month = String(nextDay.getMonth() + 1).padStart(2, '0');
            const day = String(nextDay.getDate()).padStart(2, '0');
            
            checkOutInput.min = `${year}-${month}-${day}`;
            
            // If current check-out date is before new check-in date, update it
            if (new Date(checkOutInput.value) <= checkInDate) {
                checkOutInput.value = `${year}-${month}-${day}`;
            }
        });

        const roomCategorySelect = document.getElementById('room_category_id');
        const roomCategoryDetails = document.getElementById('room-category-details');
        const roomCategoryName = document.querySelector('.room-category-name');
        const roomCategoryPrice = document.querySelector('.room-category-price');
        const roomCategoryDescription = document.querySelector('.room-category-description');
        
        // Informations des catégories
        const roomCategories = {
            @foreach($roomCategories as $category)
                {{ $category->id }}: {
                    name: "{{ $category->name }}",
                    price: "{{ number_format($category->price, 0, ',', ' ') }} FCFA",
                    description: "{{ $category->description }}"
                },
            @endforeach
        };
        
        // Afficher les détails au chargement
        updateRoomCategoryDetails();
        
        // Mettre à jour les détails lors du changement de catégorie
        roomCategorySelect.addEventListener('change', updateRoomCategoryDetails);
        
        function updateRoomCategoryDetails() {
            const selectedCategoryId = roomCategorySelect.value;
            if (selectedCategoryId && roomCategories[selectedCategoryId]) {
                const category = roomCategories[selectedCategoryId];
                roomCategoryName.textContent = category.name;
                roomCategoryPrice.textContent = category.price;
                roomCategoryDescription.textContent = category.description;
                roomCategoryDetails.style.display = 'block';
            } else {
                roomCategoryDetails.style.display = 'none';
            }
        }
    });
</script>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roomCategorySelect = document.getElementById('room_category_id');
        const roomCategoryDetails = document.getElementById('room-category-details');
        
        @if(isset($preselectedCategory))
            // Si une catégorie est présélectionnée, affichez automatiquement ses détails
            updateRoomCategoryDetails();
            roomCategoryDetails.style.display = 'block';
        @endif
        
        roomCategorySelect.addEventListener('change', function() {
            updateRoomCategoryDetails();
        });
        
        function updateRoomCategoryDetails() {
            // Votre logique existante d'affichage des détails...
        }
    });
</script>
@endpush