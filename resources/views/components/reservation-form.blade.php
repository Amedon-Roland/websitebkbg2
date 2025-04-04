{{-- filepath: resources/views/components/reservation-form.blade.php --}}
<div class="flex items-center h-[120px] justify-between bg-white p-4 rounded-lg shadow-md">
    {{-- Location --}}
    <div class="flex items-center gap-2">
        <i class="fas fa-map-marker-alt text-black"></i>
        <div>
            <p class="text-sm font-bold text-black">Location</p>
            <select class="text-sm text-gray-600 focus:outline-none">
                <option>Abuja</option>
                <option>Lomé</option>
                <option>Baguida</option>
            </select>
        </div>
    </div>

    {{-- Room Type --}}
    <div class="flex items-center gap-2">
        <i class="fas fa-bed text-black"></i>
        <div>
            <p class="text-sm font-bold text-black">Type de chambre</p>
            <select class="text-sm text-gray-600 focus:outline-none">
                <option>Standard</option>
                <option>Deluxe</option>
                <option>Suite</option>
            </select>
        </div>
    </div>

    {{-- Guests --}}
    <div class="flex items-center gap-2">
        <i class="fas fa-user text-black"></i>
        <div>
            <p class="text-sm font-bold text-black">Personne</p>
            <select class="text-sm text-gray-600 focus:outline-none">
                <option>01</option>
                <option>02</option>
                <option>03</option>
            </select>
        </div>
    </div>

    {{-- Check-in --}}
    <div class="flex items-center gap-2">
        <i class="fas fa-calendar-alt text-black"></i>
        <div>
            <p class="text-sm font-bold text-black">Enregistrement</p>
            <input type="date" class="text-sm text-gray-600 focus:outline-none">
        </div>
    </div>

    {{-- Check-out --}}
    <div class="flex items-center gap-2">
        <i class="fas fa-calendar-alt text-black"></i>
        <div>
            <p class="text-sm font-bold text-black">Vérifier</p>
            <input type="date" class="text-sm text-gray-600 focus:outline-none">
        </div>
    </div>

    {{-- Submit Button --}}
    <button class="px-6 py-3 bg-[#B71C1C] text-white rounded-lg shadow-md hover:bg-[#9A1A1A]">
        Réservez maintenant
    </button>
</div>
