@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if (session('error'))
        <div class="alert alert-error mb-6 shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Réservez votre séjour</h1>
        <p class="text-lg text-gray-600 mt-2 max-w-2xl mx-auto px-4">Complétez vos informations pour finaliser votre réservation</p>
        
        <!-- Indicateur de progression -->
        <div class="steps steps-horizontal w-full max-w-md mx-auto mt-8 px-2">
            <div class="step step-secondary">Sélection</div>
            <div class="step">Confirmation</div>
            <div class="step">Paiement</div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body p-4 md:p-6">
                <form action="{{ route('reservations.create') }}" method="POST">
                    @csrf
                    <!-- Détails du séjour -->
                    <div class="divider flex items-center gap-2">
                        <span class="badge badge-primary badge-sm text-white flex items-center justify-center w-6 h-6">1</span>
                        <h2 class="text-lg md:text-xl font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 stroke-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Détails de votre séjour
                        </h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-8">
                        <!-- Type de chambre avec dropdown amélioré -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Type de chambre</span>
                            </label>
                            <div class="dropdown w-full">
                                <label tabindex="0" class="btn btn-outline w-full justify-between font-normal m-0 border-base-300" id="room-category-btn">
                                    <span id="selected-room-category" class="truncate text-left flex-1">
                                        @foreach($roomCategories as $category)
                                            @if((request()->input('room_category_id') == $category->id) || 
                                                (isset($preselectedCategory) && $preselectedCategory->id == $category->id))
                                                {{ $category->name }} - {{ number_format($category->price, 0, ',', ' ') }} FCFA
                                            @endif
                                        @endforeach
                                        @if(!request()->input('room_category_id') && !isset($preselectedCategory))
                                            Sélectionner une chambre
                                        @endif
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down flex-shrink-0 ml-2" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </label>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-full max-h-60 overflow-auto">
                                    @foreach($roomCategories as $category)
                                        <li>
                                            <a class="room-category-option" data-value="{{ $category->id }}" data-name="{{ $category->name }} - {{ number_format($category->price, 0, ',', ' ') }} FCFA">
                                                <div>
                                                    <div class="font-medium">{{ $category->name }}</div>
                                                    <div class="text-xs opacity-70">{{ number_format($category->price, 0, ',', ' ') }} FCFA/nuit</div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" id="room_category_id" name="room_category_id" 
                                    value="{{ request()->input('room_category_id') ?: (isset($preselectedCategory) ? $preselectedCategory->id : '') }}" required>
                            </div>
                            <div class="text-error text-xs mt-1 pl-1 error-message" id="room_category_id-error" style="display: none;">Veuillez sélectionner un type de chambre</div>
                        </div>
                        
                        <!-- Nombre de personnes avec dropdown amélioré -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Nombre de personnes</span>
                            </label>
                            <div class="dropdown w-full">
                                <label tabindex="0" class="btn btn-outline w-full justify-between font-normal m-0 border-base-300" id="guests-btn">
                                    <span id="selected-guests" class="truncate text-left flex-1">
                                        {{ request()->input('guests') ? request()->input('guests') . ' ' . (request()->input('guests') > 1 ? 'personnes' : 'personne') : 'Sélectionner' }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down flex-shrink-0 ml-2" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </label>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-full">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li><a class="guests-option" data-value="{{ $i }}">{{ $i }} {{ $i > 1 ? 'personnes' : 'personne' }}</a></li>
                                    @endfor
                                </ul>
                                <input type="hidden" id="guests" name="guests" value="{{ request()->input('guests') ?: '1' }}" required>
                            </div>
                        </div>

                        <!-- Détails de la catégorie de chambre -->
                        <div class="md:col-span-2" id="room-category-details" style="display: none;">
                            <div class="alert bg-base-200 shadow-sm">
                                <div class="w-full">
                                    <div class="flex justify-between items-center mb-2 flex-wrap gap-2">
                                        <h3 class="font-semibold text-primary room-category-name"></h3>
                                        <span class="badge badge-primary text-white room-category-price"></span>
                                    </div>
                                    <p class="text-sm opacity-70 room-category-description"></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Date d'arrivée avec datepicker amélioré -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Date d'arrivée</span>
                            </label>
                            <label class="input-group input-group-md">
                                <input type="date" id="check_in_date" name="check_in_date" 
                                    value="{{ request()->input('check_in_date') ?: date('Y-m-d') }}" 
                                    min="{{ date('Y-m-d') }}" 
                                    class="input input-bordered w-full rounded-l-r focus:outline-primary" required>
                            </label>
                            <div class="text-error text-xs mt-1 pl-1 error-message" id="check_in_date-error" style="display: none;">Veuillez sélectionner une date d'arrivée</div>
                        </div>
                        
                        <!-- Date de départ avec datepicker amélioré -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Date de départ</span>
                            </label>
                            <label class="input-group input-group-md">
                                
                                <input type="date" id="check_out_date" name="check_out_date" 
                                    value="{{ request()->input('check_out_date') ?: date('Y-m-d', strtotime('+1 day')) }}" 
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                    class="input input-bordered w-full rounded-l-r focus:outline-primary" required>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Informations personnelles -->
                    <div class="divider flex items-center gap-2">
                        <span class="badge badge-primary badge-sm text-white flex items-center justify-center w-6 h-6">2</span>
                        <h2 class="text-lg md:text-xl font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 stroke-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informations personnelles
                        </h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-8">
                        <!-- Civilité avec dropdown amélioré -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Civilité</span>
                            </label>
                            <div class="dropdown w-full">
                                <label tabindex="0" class="btn btn-outline w-full justify-between font-normal m-0 border-base-300" id="title-btn">
                                    <span id="selected-title" class="truncate text-left flex-1">Sélectionner</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down flex-shrink-0 ml-2" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </label>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-full">
                                    <li><a class="title-option" data-value="M.">Monsieur</a></li>
                                    <li><a class="title-option" data-value="Mme">Madame</a></li>
                                    <li><a class="title-option" data-value="Mlle">Mademoiselle</a></li>
                                </ul>
                                <input type="hidden" id="title" name="title" value="" required>
                            </div>
                        </div>
                        
                        <!-- Nom avec style amélioré -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Nom</span>
                            </label>
                            <input type="text" id="last_name" name="last_name" 
                                class="input input-bordered w-full focus:outline-primary" required>
                            <div class="text-error text-xs mt-1 pl-1 error-message" id="last_name-error" style="display: none;">Veuillez saisir votre nom</div>
                        </div>
                        
                        <!-- Prénom avec style amélioré -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Prénom</span>
                            </label>
                            <input type="text" id="first_name" name="first_name" 
                                class="input input-bordered w-full focus:outline-primary" required>
                        </div>
                        
                        <!-- Email avec style amélioré -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Email</span>
                            </label>
                            <label class="input-group input-group-md">
                                
                                <input type="email" id="email" name="email" 
                                    class="input input-bordered w-full rounded-l-r focus:outline-primary" required>
                            </label>
                        </div>
                        
                        <!-- Téléphone avec style amélioré et correction du débordement -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Téléphone</span>
                            </label>
                            <label class="input-group input-group-md">
                                
                                <input type="tel" id="phone" name="phone" 
                                    class="input input-bordered w-full rounded-l-r focus:outline-primary" 
                                    placeholder="Ex: 01 23 45 67 89" required>
                            </label>
                        </div>
                        
                        <!-- Adresse avec style amélioré -->
                        <div class="form-control md:col-span-2">
                            <label class="label">
                                <span class="label-text font-medium">Adresse</span>
                            </label>
                            <label class="input-group input-group-md">
                                
                                <input type="text" id="address" name="address" 
                                    class="input input-bordered w-full rounded-l-rfocus:outline-primary">
                            </label>
                        </div>
                    </div>
                    
                    <!-- Préférences et demandes spéciales -->
                    <div class="divider flex items-center gap-2">
                        <span class="badge badge-primary badge-sm text-white flex items-center justify-center w-6 h-6">3</span>
                        <h2 class="text-lg md:text-xl font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 stroke-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            <span class="break-words">Préférences</span>
                        </h2>
                    </div>
                    
                    <div class="mb-8">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Demandes spéciales</span>
                            </label>
                            <textarea id="special_requests" name="special_requests" rows="3" 
                                class="textarea textarea-bordered w-full focus:outline-primary" 
                                placeholder="Ex: chambre avec vue, lit bébé, etc..."></textarea>
                        </div>
                        
                        <!-- Options supplémentaires avec style amélioré -->
                        <div class="mt-6">
                            <p class="font-medium mb-3">Options supplémentaires</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                <div class="card bg-base-100 border hover:shadow-md transition-all duration-200">
                                    <div class="card-body p-3 md:p-4">
                                        <div class="form-control">
                                            <label class="cursor-pointer label justify-start gap-2">
                                                <input type="checkbox" name="breakfast" class="checkbox checkbox-primary checkbox-sm" />
                                                <div>
                                                    <span class="label-text font-medium">Petit-déjeuner</span>
                                                    <p class="text-xs text-gray-500 mt-0.5">5 000 FCFA/séjour</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card bg-base-100 border hover:shadow-md transition-all duration-200">
                                    <div class="card-body p-3 md:p-4">
                                        <div class="form-control">
                                            <label class="cursor-pointer label justify-start gap-2">
                                                <input type="checkbox" name="late_checkout" class="checkbox checkbox-primary checkbox-sm" />
                                                <div>
                                                    <span class="label-text font-medium">Départ tardif</span>
                                                    <p class="text-xs text-gray-500 mt-0.5">Selon disponibilité</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card bg-base-100 border hover:shadow-md transition-all duration-200">
                                    <div class="card-body p-3 md:p-4">
                                        <div class="form-control">
                                            <label class="cursor-pointer label justify-start gap-2">
                                                <input type="checkbox" name="airport_transfer" class="checkbox checkbox-primary checkbox-sm" />
                                                <div>
                                                    <span class="label-text font-medium">Transfert aéroport</span>
                                                    <p class="text-xs text-gray-500 mt-0.5">Supplément</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Termes et conditions avec séparateur -->
                    <div class="divider"></div>
                    
                    <div class="form-control mb-6">
                        <label class="cursor-pointer label p-4 bg-base-200 rounded-lg flex flex-col sm:flex-row sm:items-start items-start gap-2 sm:gap-3 w-full">
                            <input type="checkbox" name="terms_accepted" class="checkbox checkbox-primary checkbox-sm mt-1 flex-shrink-0" required>
                            <span class="label-text text-sm break-words whitespace-normal w-full">
                                J'accepte les 
                                <a href="#" class="link link-primary font-medium break-words">termes et conditions</a> 
                                et la 
                                <a href="#" class="link link-primary font-medium break-words">politique de confidentialité</a> 
                                de BKBG Hotel.
                            </span>
                        </label>
                        @error('terms_accepted')
                            <span class="text-error text-xs mt-1 pl-4">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Actions avec bouton amélioré -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <a href="{{ route('acceuil') }}" class="btn btn-ghost w-full sm:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            Retour
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg gap-2 w-full sm:w-auto">
                            Continuer
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des dates d'arrivée et de départ
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

        // Gestion des détails de catégories
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
        
        // Gestionnaires pour les dropdowns personnalisés
        
        // Dropdown pour la catégorie de chambre
        const roomCategoryBtn = document.getElementById('room-category-btn');
        const selectedRoomCategory = document.getElementById('selected-room-category');
        const roomCategoryOptions = document.querySelectorAll('.room-category-option');
        const roomCategoryInput = document.getElementById('room_category_id');
        
        roomCategoryOptions.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const name = this.getAttribute('data-name');
                
                roomCategoryInput.value = value;
                selectedRoomCategory.textContent = name;
                
                // Mettre à jour les détails de la catégorie
                updateRoomCategoryDetails(value);
                // Close the dropdown by removing focus (blur) from the dropdown trigger
                document.activeElement.blur();
            });
        });
        
        // Dropdown pour le nombre de personnes
        const guestsBtn = document.getElementById('guests-btn');
        const selectedGuests = document.getElementById('selected-guests');
        const guestsOptions = document.querySelectorAll('.guests-option');
        const guestsInput = document.getElementById('guests');
        
        guestsOptions.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const text = this.textContent;
                
                guestsInput.value = value;
                selectedGuests.textContent = text;
                // Close the dropdown by removing focus (blur) from the dropdown trigger
                document.activeElement.blur();
            });
        });
        
        // Dropdown pour la civilité
        const titleBtn = document.getElementById('title-btn');
        const selectedTitle = document.getElementById('selected-title');
        const titleOptions = document.querySelectorAll('.title-option');
        const titleInput = document.getElementById('title');
        
        titleOptions.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const text = this.textContent;
                
                titleInput.value = value;
                selectedTitle.textContent = text;
                // Close the dropdown by removing focus (blur) from the dropdown trigger
                document.activeElement.blur();
            });
        });

        // Fonction pour mettre à jour les détails de la catégorie
        function updateRoomCategoryDetails(categoryId) {
            if (categoryId && roomCategories[categoryId]) {
                const category = roomCategories[categoryId];
                roomCategoryName.textContent = category.name;
                roomCategoryPrice.textContent = category.price;
                roomCategoryDescription.textContent = category.description;
                
                // Afficher avec animation
                roomCategoryDetails.style.display = 'block';
                roomCategoryDetails.classList.add('animate-pulse');
                setTimeout(() => {
                    roomCategoryDetails.classList.remove('animate-pulse');
                }, 1000);
            } else {
                roomCategoryDetails.style.display = 'none';
            }
        }
        
        // Initialisation des détails de catégorie
        const initialCategoryId = roomCategoryInput.value;
        if (initialCategoryId) {
            updateRoomCategoryDetails(initialCategoryId);
        }
        
        // Masque de saisie pour le téléphone
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // Garder uniquement les chiffres
            
            // Limiter à une longueur maximale
            if (value.length > 14) {
                value = value.substring(0, 14);
            }
            
            // Formater le numéro avec des espaces
            if (value.length > 0) {
                value = value.match(new RegExp('.{1,2}', 'g')).join(' ');
            }
            
            this.value = value;
        });
        
        // Form validation
        const reservationForm = document.querySelector('form[action="{{ route('reservations.create') }}"]');
        const errorMessages = {
            'room_category_id': 'Veuillez sélectionner un type de chambre',
            'guests': 'Veuillez indiquer le nombre de personnes',
            'check_in_date': 'Veuillez sélectionner une date d\'arrivée',
            'check_out_date': 'Veuillez sélectionner une date de départ',
            'title': 'Veuillez sélectionner une civilité',
            'last_name': 'Veuillez saisir votre nom',
            'first_name': 'Veuillez saisir votre prénom',
            'email': 'Veuillez saisir une adresse email valide',
            'phone': 'Veuillez saisir un numéro de téléphone valide',
            'terms_accepted': 'Vous devez accepter les termes et conditions'
        };

        // Show error message for a specific field
        function showError(fieldId, message) {
            const errorElement = document.getElementById(`${fieldId}-error`);
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }

        // Hide error message for a specific field
        function hideError(fieldId) {
            const errorElement = document.getElementById(`${fieldId}-error`);
            if (errorElement) {
                errorElement.style.display = 'none';
            }
        }

        // Validate email format
        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // Real-time validation for each field
        document.querySelectorAll('input, select, textarea').forEach(input => {
            if (input.hasAttribute('required') || input.id === 'email' || input.id === 'phone') {
                input.addEventListener('blur', function() {
                    validateField(this);
                });
                
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        validateField(this);
                    }
                });
            }
        });

        // Validate a single field
        function validateField(field) {
            const fieldId = field.id;
            
            // Skip if the field doesn't have validation
            if (!errorMessages[fieldId]) return true;
            
            let isValid = true;
            
            // Different validation rules based on field type
            if (field.hasAttribute('required') && !field.value.trim()) {
                showError(fieldId, errorMessages[fieldId]);
                field.classList.add('is-invalid');
                isValid = false;
            } else if (fieldId === 'email' && field.value.trim() && !isValidEmail(field.value.trim())) {
                showError(fieldId, 'Format d\'email invalide');
                field.classList.add('is-invalid');
                isValid = false;
            } else if (fieldId === 'phone' && field.value.trim() && field.value.replace(/\s/g, '').length < 8) {
                showError(fieldId, 'Numéro de téléphone incomplet');
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                hideError(fieldId);
                field.classList.remove('is-invalid');
            }
            
            return isValid;
        }

        // Form submission validation
        reservationForm.addEventListener('submit', function(e) {
            let formIsValid = true;
            
            // Validate all required fields
            document.querySelectorAll('input[required], select[required], textarea[required], #email, #phone').forEach(field => {
                if (!validateField(field)) {
                    formIsValid = false;
                }
            });
            
            // Special handling for checkbox (terms)
            const termsCheckbox = document.querySelector('input[name="terms_accepted"]');
            if (termsCheckbox && !termsCheckbox.checked) {
                showError('terms_accepted', errorMessages['terms_accepted']);
                formIsValid = false;
            }
            
            if (!formIsValid) {
                e.preventDefault();
                
                // Scroll to the first error
                const firstError = document.querySelector('.error-message[style="display: block"]');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    input.is-invalid, textarea.is-invalid, .is-invalid .input, .is-invalid .textarea, .is-invalid .select, .is-invalid .btn {
        border-color: hsl(var(--er)) !important;
    }
    
    .error-message {
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .error-message[style="display: block"] {
        opacity: 1;
    }
</style>
@endpush
@endsection