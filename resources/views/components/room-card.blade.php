{{-- filepath: resources/views/components/room-card.blade.php --}}

<div class="w-[390px] h-[450px] bg-white shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
    {{-- Image avec overlay pour voir la galerie --}}
    <div class="relative">
        <img src="{{ $image }}" alt="Room Image" class="w-full h-[250px] object-cover">
        <div class="absolute bottom-2 right-2">
            <x-room-gallery-modal :category="$category" />
        </div>
    </div>

    {{-- Room Details --}}
    <div class="p-4">
        <div class="flex justify-between items-center mb-2">
            <h3 class="text-2xl font-mulish font-bold text-primary">{{ $title }}</h3>
            <span class="text-sm text-secondary">{{ $availability }}</span>
        </div>
        <p class="text-xl font-poppins text-secondary mb-2">{{ $price }} FCFA</p>
        
        {{-- Description --}}
        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $category->description ?? 'Description non disponible' }}</p>
    </div>

    {{-- Icons and Button --}}
    <div class="flex items-center justify-between px-4 py-2 border-t border-border">
        {{-- Icons --}}
        <div class="flex gap-5 text-gray-500">
            <img src="{{ asset('icons/screen.svg') }}" alt="Screen Icon" class="w-8 h-8" title="Télévision">
            <img src="{{ asset('icons/wifi.svg') }}" alt="WiFi Icon" class="w-8 h-8" title="WiFi gratuit">
            <img src="{{ asset('icons/shower.svg') }}" alt="Shower Icon" class="w-8 h-8" title="Douche">
        </div>

        {{-- Remplacer le bouton par un formulaire --}}
        <form action="{{ route('reservations.index') }}" method="GET">
            <input type="hidden" name="preselected_category" value="{{ $category->id }}">
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded transition-colors duration-300" style="width: 143px; height: 47px;">
                Réserver
            </button>
        </form>
    </div>
</div>

