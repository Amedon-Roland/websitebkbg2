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
<div class="card bg-base-100 shadow-md hover:shadow-xl transition-all duration-300 w-full max-w-xs sm:max-w-sm mx-auto h-full group">
    {{-- Image Container avec effet de zoom au survol --}}
    <figure class="relative overflow-hidden rounded-t-xl">
        <img 
            src="{{ $image }}" 
            alt="Chambre {{ $label }}" 
            class="h-[200px] sm:h-[250px] w-full object-cover transition-transform duration-500 group-hover:scale-105"
            loading="lazy"
        >
        
        {{-- Label avec effet d'apparition et badge DaisyUI --}}
        <div class="absolute top-3 right-3 transform transition-transform duration-300 group-hover:-translate-y-1">
            <div class="badge badge-primary badge-lg text-white font-medium px-3 py-3 shadow-md">
                {{ $label }}
            </div>
        </div>
        
        {{-- Overlay discret au survol --}}
        <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </figure>
    
    {{-- Description Container --}}
    <div class="card-body p-4 sm:p-5">
        {{-- Icône décorative --}}
        <div class="flex justify-center -mt-8 mb-2">
            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shadow-md border-4 border-base-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </div>
        </div>
        
        {{-- Description Text --}}
        <p class="text-center text-sm sm:text-base text-base-content/80 font-raleway leading-relaxed">
            {{ $description }}
        </p>
        
        {{-- Séparateur élégant --}}
        <div class="divider my-2 before:bg-base-200 after:bg-base-200"></div>
        
        {{-- Bouton d'action --}}
        <div class="card-actions justify-center mt-1">
            <button class="btn btn-sm btn-outline btn-primary">
                Voir les détails
            </button>
        </div>
    </div>
</div>
