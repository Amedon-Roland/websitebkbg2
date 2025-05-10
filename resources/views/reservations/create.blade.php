@extends('layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('reservations.index') }}" class="flex items-center text-primary hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour aux options de réservation
                </a>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Confirmer votre réservation</h1>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-primary text-white p-6">
                    <h2 class="text-xl font-semibold">Récapitulatif de votre séjour</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 text-sm">
                        <div>
                            <span class="block text-gray-200">Arrivée</span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($validated['check_in_date'])->format('d/m/Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-200">Départ</span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($validated['check_out_date'])->format('d/m/Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-200">Personnes</span>
                            <span class="font-medium">{{ $validated['guests'] }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-200">Type de chambre</span>
                            <span class="font-medium">{{ $roomCategory->name }}</span>
                        </div>
                    </div>
                    
                    <!-- Information de prix et description -->
                    <div class="mt-4 p-3 bg-opacity-10 rounded-md">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-lg font-medium">{{ number_format($roomCategory->price, 0, ',', ' ') }} FCFA</span>
                            <span class="text-sm">par nuit</span>
                        </div>
                        <p class="text-sm text-gray-100">{{ $roomCategory->description }}</p>
                    </div>
                </div>
                
                <form action="{{ route('reservations.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <!-- Champs cachés pour conserver les données déjà saisies -->
                    <input type="hidden" name="room_category_id" value="{{ $validated['room_category_id'] }}">
                    <input type="hidden" name="guests" value="{{ $validated['guests'] }}">
                    <input type="hidden" name="check_in_date" value="{{ $validated['check_in_date'] }}">
                    <input type="hidden" name="check_out_date" value="{{ $validated['check_out_date'] }}">

                    @if($availableRooms->count() > 0)
                        <div class="bg-green-50 p-4 rounded-md mb-6">
                            <h3 class="text-lg text-green-800 font-medium">Chambres disponibles</h3>
                            <p class="text-green-700 text-sm">{{ $availableRooms->count() }} chambre(s) disponible(s) pour votre séjour.</p>
                            
                            @if($availableRooms->count() > 1)
                                <div class="mt-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Sélectionner une chambre spécifique (optionnel)</label>
                                    <select name="room_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                                        <option value="">Attribuer automatiquement</option>
                                        @foreach($availableRooms as $room)
                                            <option value="{{ $room->id }}">Chambre n° {{ $room->room_number }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Si vous ne choisissez pas de chambre, nous vous attribuerons la meilleure disponible.</p>
                                </div>
                            @else
                                <input type="hidden" name="room_id" value="{{ $availableRooms->first()->id }}">
                                <p class="text-sm text-gray-600 mt-2">Chambre n° {{ $availableRooms->first()->room_number }} vous sera attribuée.</p>
                            @endif
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Informations personnelles -->
                        <div class="md:col-span-2 border-b pb-4 mb-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informations personnelles</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Civilité -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Civilité</label>
                                    <select id="title" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                        <option value="">Sélectionnez</option>
                                        <option value="M." {{ isset($validated['title']) && $validated['title'] == 'M.' ? 'selected' : '' }}>Monsieur</option>
                                        <option value="Mme" {{ isset($validated['title']) && $validated['title'] == 'Mme' ? 'selected' : '' }}>Madame</option>
                                        <option value="Mlle" {{ isset($validated['title']) && $validated['title'] == 'Mlle' ? 'selected' : '' }}>Mademoiselle</option>
                                    </select>
                                </div>
                                
                                <!-- Nom -->
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                    <input type="text" id="last_name" name="last_name" value="{{ $validated['last_name'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                                
                                <!-- Prénom -->
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                                    <input type="text" id="first_name" name="first_name" value="{{ $validated['first_name'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                                
                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $validated['email'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                                
                                <!-- Téléphone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                    <input type="tel" id="phone" name="phone" value="{{ $validated['phone'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                                </div>
                                
                                <!-- Adresse -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                                    <input type="text" id="address" name="address" value="{{ $validated['address'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Méthode de paiement -->
                        <div class="md:col-span-2">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Mode de paiement</h2>
                            
                            <div class="space-y-3">
                                <label class="flex items-center p-3 border rounded-md hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="credit_card" class="h-5 w-5 text-primary" checked>
                                    <span class="ml-3 font-medium">Carte de crédit</span>
                                </label>
                                
                                <label class="flex items-center p-3 border rounded-md hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="h-5 w-5 text-primary">
                                    <span class="ml-3 font-medium">Virement bancaire</span>
                                </label>
                                
                                <label class="flex items-center p-3 border rounded-md hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="cash" class="h-5 w-5 text-primary">
                                    <span class="ml-3 font-medium">Paiement sur place</span>
                                </label>
                            </div>
                        </div>

                        <!-- Préférences -->
                        <div class="md:col-span-2">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Préférences et demandes spéciales</h2>
                            
                            <div>
                                <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-1">Demandes spéciales</label>
                                <textarea id="special_requests" name="special_requests" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">{{ $validated['special_requests'] ?? '' }}</textarea>
                            </div>
                            
                            <div class="mt-4">
                                <p class="block text-sm font-medium text-gray-700 mb-2">Options supplémentaires</p>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="breakfast" value="1" class="rounded text-primary border-gray-300 focus:ring-primary/50" {{ isset($validated['breakfast']) ? 'checked' : '' }} data-price="5000">
                                        <span class="ml-2 text-sm text-gray-700">Petit-déjeuner (5 000 FCFA/séjour)</span>
                                    </label>
                                    
                                    <label class="flex items-center">
                                        <input type="checkbox" name="pets" value="1" class="rounded text-primary border-gray-300 focus:ring-primary/50" {{ isset($validated['pets']) ? 'checked' : '' }} data-price="5000">
                                        <span class="ml-2 text-sm text-gray-700">Animaux acceptés (5 000 FCFA/séjour)</span>
                                    </label>
                                    
                                    <label class="flex items-center">
                                        <input type="checkbox" name="late_checkout" value="1" class="rounded text-primary border-gray-300 focus:ring-primary/50" {{ isset($validated['late_checkout']) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">Départ tardif (selon disponibilité)</span>
                                    </label>
                                    
                                    <label class="flex items-center">
                                        <input type="checkbox" name="airport_transfer" value="1" class="rounded text-primary border-gray-300 focus:ring-primary/50" {{ isset($validated['airport_transfer']) ? 'checked' : '' }}>
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
                    
                    <!-- Ajouter une section récapitulative des prix -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-md">
                        <h3 class="text-lg font-medium mb-3">Récapitulatif du prix</h3>
                        
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span>Prix de la chambre ({{ $roomCategory->name }})</span>
                                <span id="room-price">{{ number_format($roomCategory->price, 0, ',', ' ') }} FCFA</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span>Durée du séjour</span>
                                <span id="nights-count">
                                    {{ \Carbon\Carbon::parse($validated['check_in_date'])->diffInDays(\Carbon\Carbon::parse($validated['check_out_date'])) }} nuit(s)
                                </span>
                            </div>
                            
                            <div class="flex justify-between" id="breakfast-price-row" style="display: none;">
                                <span>Petit-déjeuner</span>
                                <span>5 000 FCFA</span>
                            </div>
                            
                            <div class="flex justify-between" id="pets-price-row" style="display: none;">
                                <span>Animaux</span>
                                <span>5 000 FCFA</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span>Taxe de séjour (obligatoire)</span>
                                <span>1 000 FCFA</span>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-2 mt-2">
                                <div class="flex justify-between font-medium">
                                    <span>Prix total</span>
                                    <span id="total-price"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-md shadow-md hover:bg-primary/90 transition">
                            Confirmer la réservation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const breakfastCheckbox = document.querySelector('input[name="breakfast"]');
            const petsCheckbox = document.querySelector('input[name="pets"]');
            const breakfastPriceRow = document.getElementById('breakfast-price-row');
            const petsPriceRow = document.getElementById('pets-price-row');
            const totalPriceElement = document.getElementById('total-price');
            
            const roomPriceText = document.getElementById('room-price').textContent;
            const roomPrice = parseFloat(roomPriceText.replace(/[^0-9]/g, ''));
            const nightsCount = parseInt(document.getElementById('nights-count').textContent);
            const taxAmount = 1000;
            
            function updateTotalPrice() {
                let total = roomPrice * nightsCount;
                
                if (breakfastCheckbox.checked) {
                    total += 5000;
                    breakfastPriceRow.style.display = 'flex';
                } else {
                    breakfastPriceRow.style.display = 'none';
                }
                
                if (petsCheckbox.checked) {
                    total += 5000;
                    petsPriceRow.style.display = 'flex';
                } else {
                    petsPriceRow.style.display = 'none';
                }
                
                // Ajouter la taxe de séjour
                total += taxAmount;
                
                // Mettre à jour l'affichage
                totalPriceElement.textContent = total.toLocaleString('fr-FR') + ' FCFA';
            }
            
            breakfastCheckbox.addEventListener('change', updateTotalPrice);
            petsCheckbox.addEventListener('change', updateTotalPrice);
            
            // Calculer le prix initial
            updateTotalPrice();
        });
    </script>
    @endpush
@endsection