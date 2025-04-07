{{-- filepath: resources/views/components/reservation-form.blade.php --}}
<div class="flex hide-on-small font-poppins items-center w-full h-[120px] justify-between bg-white p-6 shadow-md ">
    {{-- Location --}}

    <div class="flex items-start  gap-4">
        <div class="flex items-start">
            <img src="icons/localisation.svg" alt="">
        </div>
        <div class="flex flex-col" >
            <p class="text-sm font-poppins text-black">Location</p>
            <select class="text-sm text-gray-600 focus:outline-none">
                <option>Abuja</option>
                <option>Lomé</option>
                <option>Baguida</option>
            </select>
        </div>
    </div>

    {{-- Room Type --}}
    <div class="flex items-start gap-4">
        <div class="flex items-start">
            <img src="icons/room.svg" alt="">
        </div>

        <div>
            <p class="text-sm  text-black">Type de chambre</p>
            <select class="text-sm text-gray-600 focus:outline-none">
                <option>Standard</option>
                <option>Deluxe</option>
                <option>Suite</option>
            </select>
        </div>
    </div>

    {{-- Guests --}}
    <div class="flex items-start gap-4">
        <div class="flex items-start">
            <img src="icons/personne.svg" alt="">
        </div>
        <div>
            <p class="text-sm  text-black">Personne</p>
            <select class="text-sm text-gray-600 focus:outline-none">
                <option>01</option>
                <option>02</option>
                <option>03</option>
            </select>
        </div>
    </div>

    {{-- Check-in --}}
    <div class="flex items-start gap-4">
        <div class="flex items-start">
            <img src="icons/booking.svg" alt="">
        </div>

        <div>
            <p class="text-sm  text-black">Enregistrement</p>
            <input type="date" class="text-sm text-gray-600 focus:outline-none">
        </div>
    </div>

    {{-- Check-out --}}
    <div class="flex items-start gap-4">
        <div class="flex items-start">
            <img src="icons/booking.svg" alt="">
        </div>

        <div>
            <p class="text-sm  text-black">Vérifier</p>
            <input type="date" class="text-sm text-gray-600 focus:outline-none">
        </div>
    </div>

    {{-- Submit Button --}}
    <button class="px-6 py-3 w-[180px] h-[65px] flex items-center bg-primary text-white rounded-[5px] shadow-md">


        <div class="flex flex-col  items-center justify-center">
            Réservez maintenant
        </div>

    </button>
</div>
