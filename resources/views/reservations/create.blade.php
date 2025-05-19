@extends('layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('reservations.index') }}" class="btn btn-ghost btn-sm gap-2 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour aux options de réservation
                </a>
            </div>
            <div class="flex justify-center mb-4">
                <div class="steps steps-horizontal w-full max-w-md">
                    <div class="step step-secondary">Sélection</div>
                    <div class="step step-secondary">Confirmation</div>
                    <div class="step">Paiement</div>
                </div>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Confirmer votre réservation</h1>
            
            <div class="card bg-base-100 shadow-xl overflow-hidden">
                <!-- En-tête avec récapitulatif du séjour -->
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
                        <div class="alert alert-success mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <div>
                                <h3 class="font-bold">Chambres disponibles</h3>
                                <p class="text-sm">{{ $availableRooms->count() }} chambre(s) disponible(s) pour votre séjour.</p>
                            </div>
                            
                            @if($availableRooms->count() > 1)
                                <div class="form-control w-full mt-3">
                                    <label class="label">
                                        <span class="label-text font-medium">Sélectionner une chambre spécifique (optionnel)</span>
                                    </label>
                                    <div class="relative w-full">
                                        <button type="button" tabindex="0" role="button" class="select select-bordered w-full flex justify-between items-center px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition bg-white text-gray-800" id="room-dropdown-btn">
                                            <span id="selected-room-text" class="truncate">Attribuer automatiquement</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                        <ul id="room-dropdown-list" class="absolute left-0 right-0 mt-1 z-10 menu p-2 shadow bg-base-100 text-gray-800 rounded-box w-full max-h-60 overflow-y-auto border border-base-200 transition-all duration-150 opacity-0 pointer-events-none invisible">
                                            <li>
                                                <a data-value="" class="room-option active flex items-center gap-2 px-2 py-2 rounded hover:bg-primary hover:text-white transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Attribuer automatiquement
                                                </a>
                                            </li>
                                            @foreach($availableRooms as $room)
                                                <li>
                                                    <a data-value="{{ $room->id }}" class="room-option flex items-center gap-2 px-2 py-2 rounded hover:bg-primary hover:text-white transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-300 invisible group-hover:visible" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Chambre n° {{ $room->room_number }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <input type="hidden" name="room_id" id="room-id-input" value="">
                                    <label class="label">
                                        <span class="label-text-alt">Si vous ne choisissez pas de chambre, nous vous attribuerons la meilleure disponible.</span>
                                    </label>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dropdownBtn = document.getElementById('room-dropdown-btn');
                                        const dropdownList = document.getElementById('room-dropdown-list');
                                        const roomOptions = dropdownList.querySelectorAll('.room-option');
                                        const selectedRoomText = document.getElementById('selected-room-text');
                                        const roomIdInput = document.getElementById('room-id-input');

                                        // Toggle dropdown
                                        dropdownBtn.addEventListener('click', function(e) {
                                            e.stopPropagation();
                                            const isOpen = dropdownList.classList.contains('opacity-100');
                                            if (!isOpen) {
                                                dropdownList.classList.remove('opacity-0', 'pointer-events-none', 'invisible');
                                                dropdownList.classList.add('opacity-100');
                                            } else {
                                                dropdownList.classList.add('opacity-0', 'pointer-events-none', 'invisible');
                                                dropdownList.classList.remove('opacity-100');
                                            }
                                        });

                                        // Close dropdown on click outside
                                        document.addEventListener('click', function(e) {
                                            if (!dropdownBtn.contains(e.target)) {
                                                dropdownList.classList.add('opacity-0', 'pointer-events-none', 'invisible');
                                                dropdownList.classList.remove('opacity-100');
                                            }
                                        });

                                        // Option selection
                                        roomOptions.forEach(option => {
                                            option.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                const value = this.getAttribute('data-value');
                                                const text = this.textContent.trim();

                                                roomIdInput.value = value;
                                                selectedRoomText.textContent = text;

                                                // Update active state
                                                roomOptions.forEach(opt => opt.classList.remove('active'));
                                                this.classList.add('active');

                                                // Close dropdown
                                                dropdownList.classList.add('opacity-0', 'pointer-events-none', 'invisible');
                                                dropdownList.classList.remove('opacity-100');
                                            });
                                        });
                                    });
                                </script>
                            @else
                                <input type="hidden" name="room_id" value="{{ $availableRooms->first()->id }}">
                                <p class="text-sm mt-2">Chambre n° {{ $availableRooms->first()->room_number }} vous sera attribuée.</p>
                            @endif
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Informations personnelles -->
                        <div class="md:col-span-2 divider">
                            <h2 class="text-xl font-semibold text-gray-800">Informations personnelles</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Civilité -->
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Civilité</span>
                                </label>
                                <div class="dropdown w-full">
                                    <div tabindex="0" role="button" class="select select-bordered w-full flex justify-between items-center">
                                        <span id="selected-title-text">{{ isset($validated['title']) ? ($validated['title'] == 'M.' ? 'Monsieur' : ($validated['title'] == 'Mme' ? 'Madame' : 'Mademoiselle')) : 'Sélectionnez' }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </div>
                                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-full">
                                        <li><a data-value="M." class="title-option {{ isset($validated['title']) && $validated['title'] == 'M.' ? 'active' : '' }}">Monsieur</a></li>
                                        <li><a data-value="Mme" class="title-option {{ isset($validated['title']) && $validated['title'] == 'Mme' ? 'active' : '' }}">Madame</a></li>
                                        <li><a data-value="Mlle" class="title-option {{ isset($validated['title']) && $validated['title'] == 'Mlle' ? 'active' : '' }}">Mademoiselle</a></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="title" id="title-input" value="{{ $validated['title'] ?? '' }}" required>
                            </div>
                            
                            <!-- Nom -->
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Nom</span>
                                </label>
                                <input type="text" id="last_name" name="last_name" value="{{ $validated['last_name'] ?? '' }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <!-- Prénom -->
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Prénom</span>
                                </label>
                                <input type="text" id="first_name" name="first_name" value="{{ $validated['first_name'] ?? '' }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <!-- Email -->
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ $validated['email'] ?? '' }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <!-- Téléphone -->
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Téléphone</span>
                                </label>
                                <input type="tel" id="phone" name="phone" value="{{ $validated['phone'] ?? '' }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <!-- Adresse -->
                            <div class="form-control w-full md:col-span-2">
                                <label class="label">
                                    <span class="label-text">Adresse</span>
                                </label>
                                <input type="text" id="address" name="address" value="{{ $validated['address'] ?? '' }}" class="input input-bordered w-full">
                            </div>
                        </div>
                        
                        <!-- Méthode de paiement -->
                        <div class="md:col-span-2 mt-6">
                            <div class="divider">
                                <h2 class="text-xl font-semibold text-gray-800">Mode de paiement</h2>
                            </div>
                            
                            <div class="form-control w-full">
                                <div class="dropdown w-full">
                                    <div tabindex="0" role="button" class="select select-bordered w-full flex justify-between items-center">
                                        <span id="selected-payment-text">Carte de crédit</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </div>
                                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-full">
                                        <li>
                                            <a data-value="credit_card" class="payment-option active">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                                Carte de crédit
                                            </a>
                                        </li>
                                        <li>
                                            <a data-value="bank_transfer" class="payment-option">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                </svg>
                                                Virement bancaire
                                            </a>
                                        </li>
                                        <li>
                                            <a data-value="cash" class="payment-option">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Paiement sur place
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <input type="hidden" name="payment_method" id="payment-method-input" value="credit_card">
                            </div>
                        </div>

                        <!-- Préférences -->
                        <div class="md:col-span-2 mt-6">
                            <div class="divider">
                                <h2 class="text-xl font-semibold text-gray-800">Préférences et demandes spéciales</h2>
                            </div>
                            
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Demandes spéciales</span>
                                </label>
                                <textarea id="special_requests" name="special_requests" rows="3" class="textarea textarea-bordered w-full">{{ $validated['special_requests'] ?? '' }}</textarea>
                            </div>
                            
                            <div class="mt-4">
                                <p class="label-text mb-2 font-medium">Options supplémentaires</p>
                                <div class="flex flex-col gap-3">
                                    <label class="label cursor-pointer justify-start gap-3">
                                        <input type="checkbox" name="breakfast" value="1" class="checkbox checkbox-primary" {{ isset($validated['breakfast']) ? 'checked' : '' }} data-price="5000">
                                        <span class="text-sm">Petit-déjeuner (5 000 FCFA/séjour)</span>
                                    </label>
                                    
                                    <label class="label cursor-pointer justify-start gap-3">
                                        <input type="checkbox" name="pets" value="1" class="checkbox checkbox-primary" {{ isset($validated['pets']) ? 'checked' : '' }} data-price="5000">
                                        <span class="text-sm">Animaux acceptés (5 000 FCFA/séjour)</span>
                                    </label>
                                    
                                    <label class="label cursor-pointer justify-start gap-3">
                                        <input type="checkbox" name="late_checkout" value="1" class="checkbox checkbox-primary" {{ isset($validated['late_checkout']) ? 'checked' : '' }}>
                                        <span class="text-sm">Départ tardif (selon disponibilité)</span>
                                    </label>
                                    
                                    <label class="label cursor-pointer justify-start gap-3">
                                        <input type="checkbox" name="airport_transfer" value="1" class="checkbox checkbox-primary" {{ isset($validated['airport_transfer']) ? 'checked' : '' }}>
                                        <span class="text-sm">Transfert aéroport (supplément)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Termes et conditions -->
                        <div class="md:col-span-2 mt-6">
                            <label class="label cursor-pointer justify-start gap-3">
                                <input type="checkbox" name="terms_accepted" class="checkbox checkbox-primary" required>
                                <span class="text-sm">
                                    J'accepte les <a href="#" class="link link-primary">termes et conditions</a> et la <a href="#" class="link link-primary">politique de confidentialité</a>
                                </span>
                            </label>
                            @error('terms_accepted')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Récapitulatif des prix -->
                    <div class="mt-8 card bg-base-200 p-4 shadow-sm">
                        <h3 class="card-title mb-3">Récapitulatif du prix</h3>
                        
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
                            
                            <div class="divider my-1"></div>
                            
                            <div class="flex justify-between font-medium text-lg">
                                <span>Prix total</span>
                                <span id="total-price" class="badge badge-lg badge-primary text-base-100"></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="btn btn-primary">
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
            // Code existant pour le calcul du prix
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
            
            // Nouvelle gestion des dropdowns personnalisés
            
            // Dropdown pour la sélection de chambre
            const roomOptions = document.querySelectorAll('.room-option');
            const selectedRoomText = document.getElementById('selected-room-text');
            const roomIdInput = document.getElementById('room-id-input');
            
            if (roomOptions.length > 0) {
                roomOptions.forEach(option => {
                    option.addEventListener('click', function() {
                        const value = this.getAttribute('data-value');
                        const text = this.textContent;
                        
                        roomIdInput.value = value;
                        selectedRoomText.textContent = text;
                        
                        // Mise à jour de l'état actif
                        roomOptions.forEach(opt => opt.classList.remove('active'));
                        this.classList.add('active');
                    });
                });
            }
            
            // Dropdown pour la civilité
            const titleOptions = document.querySelectorAll('.title-option');
            const selectedTitleText = document.getElementById('selected-title-text');
            const titleInput = document.getElementById('title-input');
            
            titleOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const text = this.textContent;
                    
                    titleInput.value = value;
                    selectedTitleText.textContent = text;
                    
                    // Mise à jour de l'état actif
                    titleOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    document.activeElement.blur();
                });
            });
            
            // Dropdown pour le mode de paiement
            const paymentOptions = document.querySelectorAll('.payment-option');
            const selectedPaymentText = document.getElementById('selected-payment-text');
            const paymentMethodInput = document.getElementById('payment-method-input');
            
            paymentOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const text = this.textContent.trim();
                    
                    paymentMethodInput.value = value;
                    selectedPaymentText.textContent = text;
                    
                    // Mise à jour de l'état actif
                    paymentOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    document.activeElement.blur();
                });
            });
        });
    </script>
    @endpush
@endsection