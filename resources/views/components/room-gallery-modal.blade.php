<div 
    x-data="{ open: false, activeSlide: 0, slides: [] }" 
    x-init="slides = [
        '{{ $category->image ? asset('storage/' . $category->image) : asset('images/room.jpg') }}',
        @foreach($category->galleryImages as $image)
            '{{ asset('storage/' . $image->image) }}',
        @endforeach
    ]"
>
    <!-- Bouton pour ouvrir la galerie -->
    <div class="absolute bottom-4 right-4 z-10">
        <button 
            @click="open = true" 
            type="button"
            class="flex items-center bg-white bg-opacity-90 hover:bg-opacity-100 text-primary hover:text-primary-dark px-3 py-2 rounded-lg shadow-lg transform transition hover:scale-105 hover:shadow-xl"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="font-medium">{{ count($category->galleryImages) + 1 }} photos</span>
        </button>
    </div>

    <!-- Modal de galerie -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-20"
        style="display: none; backdrop-filter: blur(8px);"
        @keydown.escape.window="open = false"
    >
        <!-- Overlay avec gradient élégant -->
        <div class="fixed inset-0 bg-gradient-to-br from-gray-900/90 to-black/95" @click="open = false"></div>
        
        <!-- Container de la modal -->
        <div class="bg-white rounded-xl shadow-2xl max-w-6xl w-full mx-auto overflow-hidden z-10 relative">
            <!-- Header -->
            <div class="flex justify-between items-center p-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 pl-2">{{ $category->name }}</h3>
                <button @click="open = false" class="rounded-full p-2 hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Slider avec fond dégradé élégant -->
            <div class="relative bg-gradient-to-b from-gray-50 to-gray-100">
                <div class="aspect-w-16 aspect-h-9">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div 
                            x-show="activeSlide === index"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            class="h-[60vh] flex items-center justify-center p-4"
                        >
                            <img 
                                :src="slide" 
                                alt="Room image" 
                                class="max-h-full max-w-full object-contain rounded shadow-lg"
                                @load="$el.classList.add('animate-fade-in')"
                            >
                        </div>
                    </template>
                </div>

                <!-- Indicateur de position -->
                <div class="absolute top-4 right-4 bg-white bg-opacity-80 text-gray-800 px-4 py-1 rounded-full text-sm font-medium shadow-md">
                    <span x-text="activeSlide + 1"></span>/<span x-text="slides.length"></span>
                </div>

                <!-- Contrôles de navigation -->
                <button 
                    @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" 
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-md hover:shadow-lg transition-all hover:bg-gray-50"
                >
                    <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <button 
                    @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" 
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-md hover:shadow-lg transition-all hover:bg-gray-50"
                >
                    <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Miniatures avec fond blanc et bordure subtile -->
            <div class="p-4 bg-white border-t border-gray-100">
                <div class="flex space-x-3 overflow-x-auto pb-2 px-1">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button 
                            @click="activeSlide = index" 
                            :class="{
                                'border-primary ring-2 ring-primary/30': activeSlide === index,
                                'border-transparent opacity-70 hover:opacity-100': activeSlide !== index
                            }"
                            class="flex-shrink-0 h-20 w-28 rounded-md overflow-hidden shadow-sm border-2 transition-all duration-200 transform hover:scale-105"
                        >
                            <img :src="slide" alt="Thumbnail" class="h-full w-full object-cover">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.98); }
    to { opacity: 1; transform: scale(1); }
}
</style>