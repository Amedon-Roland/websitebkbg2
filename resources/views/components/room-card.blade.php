{{-- filepath: resources/views/components/room-card.blade.php --}}

<div class="card w-full sm:w-[360px] md:w-[390px] bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 group h-full mx-auto my-2 px-3 sm:px-0">
    {{-- Image avec overlay pour voir la galerie --}}
    <figure class="relative overflow-hidden">
        <img 
            src="{{ $image }}" 
            alt="{{ $title }}" 
            class="h-[250px] w-full object-cover transition-transform duration-500 group-hover:scale-105" 
            loading="lazy"
        >
        
        {{-- Badge disponibilité - maintenant responsive --}}
        <div class="absolute top-2 sm:top-3 left-2 sm:left-3">
            <span class="badge badge-{{ $availability === 'Disponible' ? 'success' : 'warning' }} font-semibold text-xs sm:text-sm px-2 py-2 sm:px-3 sm:py-3">
                <span class="relative flex h-1.5 sm:h-2 w-1.5 sm:w-2 mr-1">
                    <span class="{{ $availability === 'Disponible' ? 'animate-ping absolute h-full w-full rounded-full bg-success opacity-75' : 'hidden' }}"></span>
                    <span class="relative inline-flex rounded-full h-1.5 sm:h-2 w-1.5 sm:w-2 {{ $availability === 'Disponible' ? 'bg-success' : 'bg-warning' }}"></span>
                </span>
                {{ $availability }}
            </span>
        </div>
        
        {{-- Bouton galerie --}}
        <div class="absolute bottom-2 sm:bottom-3 right-2 sm:right-3">
            <x-room-gallery-modal :category="$category" />
        </div>
        
        {{-- Prix avec effet - maintenant responsive --}}
        <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
            <div class="badge badge-primary text-xs sm:text-sm md:text-base px-2 py-2 sm:px-3 sm:py-2.5 md:px-4 md:py-3 font-semibold md:font-bold shadow-lg">
                {{ $price }} FCFA
            </div>
        </div>
    </figure>

    <div class="card-body p-3 sm:p-4 md:p-5">
        {{-- Title --}}
        <h2 class="card-title text-xl sm:text-2xl font-mulish font-bold text-primary">
            {{ $title }}
            <div class="badge badge-outline badge-secondary text-[10px] sm:text-xs ml-1 sm:ml-2">Premium</div>
        </h2>
        
        {{-- Description --}}
        <p class="text-xs sm:text-sm text-base-content/80 line-clamp-2 mt-1">
            {{ $category->description ?? 'Description non disponible' }}
        </p>
        
        {{-- Caractéristiques --}}
        <div class="flex flex-wrap gap-1 sm:gap-2 my-2 sm:my-3">
            <div class="tooltip tooltip-primary" data-tip="Télévision">
                <div class="badge badge-ghost gap-1 p-2 sm:p-3 text-xs sm:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 sm:w-4 sm:h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                    TV
                </div>
            </div>
            
            <div class="tooltip tooltip-primary" data-tip="WiFi gratuit">
                <div class="badge badge-ghost gap-1 p-2 sm:p-3 text-xs sm:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 sm:w-4 sm:h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" />
                    </svg>
                    WiFi
                </div>
            </div>
            
            <div class="tooltip tooltip-primary" data-tip="Douche">
                <div class="badge badge-ghost gap-1 p-2 sm:p-3 text-xs sm:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 sm:w-4 sm:h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" />
                    </svg>
                    Douche
                </div>
            </div>
        </div>
        
        <div class="card-actions mt-auto pt-2 sm:pt-3 border-t border-base-300">
            <div class="grid grid-cols-2 w-full items-center">
                <div class="rating rating-xs sm:rating-sm">
                    <input type="radio" name="rating-{{ $category->id }}" class="mask mask-star-2 bg-primary" checked />
                    <input type="radio" name="rating-{{ $category->id }}" class="mask mask-star-2 bg-primary" checked />
                    <input type="radio" name="rating-{{ $category->id }}" class="mask mask-star-2 bg-primary" checked />
                    <input type="radio" name="rating-{{ $category->id }}" class="mask mask-star-2 bg-primary" checked />
                    <input type="radio" name="rating-{{ $category->id }}" class="mask mask-star-2 bg-primary" />
                </div>
                
                <form action="{{ route('reservations.index') }}" method="GET" class="flex justify-end">
                    <input type="hidden" name="preselected_category" value="{{ $category->id }}">
                    <button type="submit" class="btn btn-primary btn-sm sm:btn-md text-white hover:scale-105 transition-transform text-xs sm:text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        Réserver
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

