{{-- filepath: resources/views/components/room-card-desc.blade.php --}}
{{--
    Composant : Room Card Description
    Description : Affiche une carte contenant une image, un label, et une description.
    Props :
        - $image (string) : URL de l'image à afficher.
        - $label (string) : Texte du label affiché en haut à droite de l'image.
        - $description (string) : Texte de description affiché sous l'image.
    Exemple d'utilisation :
        <x-room-card-desc
            image="{{ asset('images/room1.jpg') }}"
            label="Premium"
            description="Très spacieuses, bien équipées avec 2 lits doubles, Vue sur la Mer"
        />
--}}
<div class="w-[385px] h-[384px] bg-white rounded-[5px] shadow-md flex items-center justify-center">
    {{-- Content Wrapper --}}
    <div class="flex flex-col items-center gap-4">
        {{-- Image Section --}}
        <div class="relative">
            <img src="{{ $image }}" alt="Room Image" class="h-[285px] w-[330px] object-cover rounded-[5px]">
            <span class="absolute w-[107px] h-[34px] rounded-[2.5px] top-2 right-2 bg-primary text-white text-center text-xs font-bold flex items-center justify-center">
                {{ $label }}
            </span>
        </div>

        {{-- Description Section --}}
        <div class="text-center mr-5 ml-5">
            <p class="text-sm text-black font-raleway">
                {{ $description }}
            </p>
        </div>
    </div>
</div>
