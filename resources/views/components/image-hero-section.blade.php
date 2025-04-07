<div 
    class="relative w-full h-[700px] mx-auto text-white overflow-hidden border-2 border-white"
    id="hero-section"
>
    <!-- Overlay utilisant la variable CSS -->
    <div class="absolute inset-0 z-0" style="background: var(--color-secondary); opacity: 0.31;"></div>
    
    <!-- Contenu centré directement dans la section hero -->
    <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center px-4 translate-y-12">
        <!-- Titre -->
        <h1 class="font-mulish font-extrabold text-[36px] sm:text-[48px] md:text-[60px] leading-[1] mb-8">
            {{ $title }}
        </h1>
        
        <!-- Description -->
        <p class="font-mulish font-semibold text-[18px] md:text-[20px] max-w-[1157px] mb-16">
            {{ $description }}
        </p>
        
        <!-- Scroll Button -->
        @if ($showScrollButton)
        <a 
            href="#{{ $scrollTarget }}" 
            class="w-[50px] h-[90px] border-2 border-white flex items-center justify-center text-white cursor-pointer rounded-full animate-bounce transition-all duration-300 hover:bg-white hover:text-black"
            style="scroll-behavior: smooth;"
        >
            <span class="text-3xl">↓</span>
        </a>
        @endif
    </div>
</div>

<!-- Style CSS pour l'image de fond -->
<style>
    #hero-section {
        background-image: url('{{ $backgroundImage }}');
        background-size: cover;
        background-position: center;
    }
</style>