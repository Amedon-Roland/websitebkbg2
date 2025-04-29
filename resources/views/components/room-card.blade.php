{{-- filepath: resources/views/components/room-card.blade.php --}}

<div class="w-[390px] h-[414px] bg-white  shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
    {{-- Image --}}
    <img src="{{ $image }}" alt="Room Image" class="w-full h-[250px] object-cover">

    {{-- Room Details --}}
    <div class="p-4">
        <div class="flex justify-between items-center mb-2">
            <h3 class="text-2xl font-mulish font-bold text-primary">{{ $title }}</h3>
            <span class="text-sm text-secondary">{{ $availability }}</span>
        </div>
        <p class="text-xl font-poppins text-secondary">{{ $price }} FCFA</p>
    </div>

    {{-- Icons and Button --}}
    <div class="flex items-center justify-between px-4 py-2 border-t border-border">
        {{-- Icons --}}
        <div class="flex gap-5 text-gray-500">
            <img src="{{ asset('icons/screen.svg') }}" alt="Screen Icon" class="w-8 h-8">
            <img src="{{ asset('icons/wifi.svg') }}" alt="WiFi Icon" class="w-8 h-8">
            <img src="{{ asset('icons/shower.svg') }}" alt="Shower Icon" class="w-8 h-8">
        </div>

        {{-- Button --}}
        <x-button width="143px" height="47px" cornerRadius="0px" fontweight="" >Réserver</x-button>
    </div>
</div>

