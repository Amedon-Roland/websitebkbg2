{{-- filepath: resources/views/components/installation-card.blade.php --}}
{{--
    Composant : Installation Card
    Description : Affiche une carte contenant une icône et un titre pour une installation.
    Props :
        - $icon (string) : URL de l'icône à afficher.
        - $title (string) : Texte du titre affiché sous l'icône.
    Exemple d'utilisation :
        <x-installation-card
            icon="{{ asset('icons/pool.svg') }}"
            title="Piscine"
        />
--}}
<div class="flex flex-col items-center justify-center p-2">
    {{-- Icon --}}
    <img src="{{ $icon }}" alt="{{ $title }}" class="w-8 h-8 mb-1 text-primary sm:w-13 sm:h-[40px] sm:mb-2">

    {{-- Title --}}
    <p class="text-xs text-primary font-poppins font-medium text-center sm:text-base">{{ $title }}</p>
</div>
