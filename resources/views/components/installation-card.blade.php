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
<div class="w-[280px] h-[250px] bg-background shadow-md flex flex-col items-center rounded-[5px] justify-center hover:shadow-lg transition-shadow duration-300">
    {{-- Icon --}}
    <img src="{{ $icon }}" alt="{{ $title }}" class="w-13 h-[40px] mb-2">

    {{-- Title --}}
    <p class="text-secondary font-poppins font-medium text-center">{{ $title }}</p>
</div>
