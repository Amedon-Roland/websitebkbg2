{{-- filepath: resources/views/components/reservation-form.blade.php --}}
@props(['compact' => false, 'roomCategories' => collect()])

<form action="{{ route('reservations.index') }}" method="GET">
    <!-- Ajouter ce champ caché juste après l'ouverture du formulaire -->
    <input type="hidden" name="guests" value="1">
    
    <div class="flex hide-on-small font-poppins items-center w-full h-auto lg:h-[120px] justify-between bg-base-100 p-4 lg:p-6 shadow-lg rounded-lg gap-4 flex-wrap lg:flex-nowrap">
        {{-- Room Type --}}
        <div class="form-control w-full lg:w-auto">
            <label class="label p-0 pb-1">
                <span class="label-text font-medium flex items-center gap-2">
                    <img src="{{ asset('icons/room.svg') }}" alt="" class="w-5 h-5">
                    Type de chambre
                </span>
            </label>
            <select name="room_category_id" class="select select-bordered w-full" required>
                <option disabled selected>Choisir une chambre</option>
                @foreach($roomCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        

        {{-- Guests --}}
        <div class="form-control w-full lg:w-auto hide-guests-responsive">
            <label class="label p-0 pb-1">
                <span class="label-text font-medium flex items-center gap-2">
                    <img src="{{ asset('icons/personne.svg') }}" alt="" class="w-5 h-5">
                    Personnes
                </span>
            </label>
            <select name="guests" class="select select-bordered w-full" required>
                <option disabled selected>Nombre</option>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
                <option value="5">05</option>
            </select>
        </div>

        {{-- Check-in --}}
        <div class="form-control w-full lg:w-auto">
            <label class="label p-0 pb-1">
                <span class="label-text font-medium flex items-center gap-2">
                    <img src="{{ asset('icons/booking.svg') }}" alt="" class="w-5 h-5">
                    Date d'arrivée
                </span>
            </label>
            <input type="date" name="check_in_date" class="input input-bordered w-full" 
                min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
        </div>

        {{-- Check-out --}}
        <div class="form-control w-full lg:w-auto">
            <label class="label p-0 pb-1">
                <span class="label-text font-medium flex items-center gap-2">
                    <img src="{{ asset('icons/booking.svg') }}" alt="" class="w-5 h-5">
                    Date de départ
                </span>
            </label>
            <input type="date" name="check_out_date" class="input input-bordered w-full" 
                min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                value="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary w-full lg:w-auto lg:h-[65px] mt-auto">
            <span class="hidden lg:inline">vérifier</span>
            <span class="lg:hidden">Réserver</span>
        </button>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = document.querySelector('input[name="check_in_date"]');
        const checkOutInput = document.querySelector('input[name="check_out_date"]');
        
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
    });
</script>
@endpush
