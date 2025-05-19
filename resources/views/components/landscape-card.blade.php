{{-- filepath: resources/views/components/landscape-card.blade.php --}}
{{--
    Composant : Landscape Card
    Description : Affiche une carte avec une image de fond, un overlay contenant un titre, une description, et une barre d'accent.
    Props :
        - $image (string) : URL de l'image de fond.
        - $title (string) : Titre affiché dans l'overlay.
        - $description (string) : Description affichée sous le titre dans l'overlay.
--}}

<div class="relative w-full max-w-[1272px] mx-auto my-10 group">
    {{-- Background Image with DaisyUI Image Mask --}}
    <div class="relative h-[300px] xs:h-[350px] sm:h-[400px] md:h-[450px] lg:h-[570px] overflow-hidden">
        <img 
            src="{{ $image }}" 
            alt="{{ $title }}" 
            class="w-full h-full object-cover rounded-2xl md:rounded-3xl lg:rounded-[40px] transition-transform duration-700 group-hover:scale-105"
        >
        
        {{-- Subtle Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/10 to-black/40 rounded-2xl md:rounded-3xl lg:rounded-[40px] opacity-60"></div>
        
        {{-- Badge in the corner --}}
        <div class="absolute top-4 left-4 md:top-6 md:left-6">
            <div class="badge badge-primary badge-lg text-white font-medium px-4 py-3">
                BKBG Collection
            </div>
        </div>
    </div>

    {{-- Content Card with DaisyUI Card --}}
    <div class="card bg-base-100 shadow-xl w-[92%] sm:w-[85%] md:w-[80%] lg:w-[75%] max-w-3xl mx-auto -mt-20 sm:-mt-24 md:-mt-28 lg:-mt-32 z-10 relative transition-all duration-300 group-hover:-translate-y-2 group-hover:shadow-2xl">
        {{-- Colored Accent Bar --}}
        <div class="h-2 w-full bg-primary rounded-t-2xl"></div>
        
        <div class="card-body p-5 sm:p-8">
            {{-- Title with Typography --}}
            <h2 class="card-title text-xl sm:text-2xl md:text-3xl font-raleway text-primary justify-center mb-2 md:mb-4">
                {{ $title }}
                <div class="badge badge-primary badge-outline ml-2 hidden sm:flex">Nouveau</div>
            </h2>
            
            {{-- Divider --}}
            <div class="divider my-0 before:bg-gray-200 after:bg-gray-200"></div>
            
            {{-- Description --}}
            <p class="text-sm sm:text-base text-center text-gray-600 leading-relaxed max-w-2xl mx-auto">
                {{ $description }}
            </p>
            
            {{-- Action Button --}}
            <div class="card-actions justify-center mt-4">
                <button class="btn btn-primary btn-outline text-sm sm:text-base group-hover:btn-primary transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    Voir la galerie
                </button>
            </div>
        </div>
    </div>
    
    {{-- Mobile Badge (shown only on small screens) --}}
    <div class="badge badge-primary badge-outline absolute top-4 right-4 sm:hidden">
        Nouveau
    </div>
</div>

