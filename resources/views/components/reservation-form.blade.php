{{-- filepath: resources/views/components/reservation-form.blade.php --}}
@props(['compact' => false, 'roomCategories' => collect()])

<form action="{{ route('reservations.index') }}" method="GET">
    <div class="flex hide-on-small font-poppins items-center w-full h-[120px] justify-between bg-white p-6 shadow-md">
        {{-- Room Type --}}
        <div class="flex items-start gap-4">
            <div class="flex items-start">
                <img src="{{ asset('icons/room.svg') }}" alt="">
            </div>

            <div>
                <p class="text-sm text-black">Type de chambre</p>
                <select name="room_category_id" class="text-sm text-gray-600 focus:outline-none" required>
                    @foreach($roomCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Guests --}}
        <div class="flex items-start gap-4">
            <div class="flex items-start">
                <img src="{{ asset('icons/personne.svg') }}" alt="">
            </div>
            <div>
                <p class="text-sm text-black">Personne</p>
                <select name="guests" class="text-sm text-gray-600 focus:outline-none" required>
                    <option value="1">01</option>
                    <option value="2">02</option>
                    <option value="3">03</option>
                    <option value="4">04</option>
                    <option value="5">05</option>
                </select>
            </div>
        </div>

        {{-- Check-in --}}
        <div class="flex items-start gap-4">
            <div class="flex items-start">
                <img src="{{ asset('icons/booking.svg') }}" alt="">
            </div>

            <div>
                <p class="text-sm text-black">Date d'arrivée</p>
                <input type="date" name="check_in_date" class="text-sm text-gray-600 focus:outline-none" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
            </div>
        </div>

        {{-- Check-out --}}
        <div class="flex items-start gap-4">
            <div class="flex items-start">
                <img src="{{ asset('icons/booking.svg') }}" alt="">
            </div>

            <div>
                <p class="text-sm text-black">Départ</p>
                <input type="date" name="check_out_date" class="text-sm text-gray-600 focus:outline-none" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
            </div>
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="px-6 py-3 w-[180px] h-[65px] flex items-center bg-primary text-white rounded-[5px] shadow-md hover:bg-primary/90 transition">
            <div class="flex flex-col items-center justify-center">
                Réservez maintenant
            </div>
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
