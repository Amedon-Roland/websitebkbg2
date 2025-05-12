{{-- filepath: resources/views/components/landscape-card.blade.php --}}
{{--
    Composant : Landscape Card
    Description : Affiche une carte avec une image de fond, un overlay contenant un titre, une description, et une barre rouge en haut.
    Props :
        - $image (string) : URL de l'image de fond.
        - $title (string) : Titre affiché dans l'overlay.
        - $description (string) : Description affichée sous le titre dans l'overlay.
    Exemple d'utilisation :
        <x-landscape-card
            image="{{ asset('images/room1.jpg') }}"
            title="Chambres luxueuses"
            description="Les chambres de luxe élégantes de cette galerie présentent des designs d'intérieur et des idées de décoration personnalisées. Regardez des photos et trouvez le design de chambre de luxe idéal. Des chambres luxueuses qui vous donneront envie de ne plus jamais quitter votre chambre."
        />
--}}
<div class="relative w-full max-w-[1272px] h-[653px] overflow-hidden mx-auto">
    {{-- Background Image --}}
    <img src="{{ $image }}" alt="Landscape Image" class="w-full h-[570px] rounded-[40px] object-cover">

    {{-- Content Overlay --}}
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-white 
                w-[90%] sm:w-[600px] md:w-[700px] lg:w-[790px] 
                h-auto rounded-[20px] p-6 sm:p-8 shadow-lg shadow-gray-500/25">
        
        {{-- Red Bar --}}
        <div class="absolute top-0 left-0 w-full h-[20px] bg-primary rounded-t-[20px]"></div>

        {{-- Title --}}
        <h3 class="text-xl sm:text-2xl font-medium font-raleway text-primary mb-3 sm:mb-4 text-center">
            {{ $title }}
        </h3>

        {{-- Description --}}
        <p class="text-sm font-raleway text-black leading-relaxed text-center">
            {{ $description }}
        </p>
    </div>
</div>

