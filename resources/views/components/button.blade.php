{{-- filepath: resources/views/components/button.blade.php --}}
{{--
    Composant : Button
    Description : Affiche un bouton personnalisable avec des dimensions dynamiques.
    Props :
        - $width (string) : Largeur du bouton (par défaut : `165px`).
        - $height (string) : Hauteur du bouton (par défaut : `55px`).
        - $cornerRadius (string) : Rayon des coins du bouton (par défaut : `5px`).
        - $fontweight (string) : Poids de la police (par défaut : `500`).
    Exemple d'utilisation :
        <x-button
            width="200px"
            height="60px"
            cornerRadius="10px"
            fontweight="700"
        >
            Réserver
        </x-button>
--}}
<div
    class="bg-primary font-poppins text-white text-center flex items-center justify-center cursor-pointer"
    style="width: {{ $width }}; height: {{ $height }}; border-radius: {{ $cornerRadius }}; font-weight: {{ $fontweight }};"
    {{ $attributes }}
>
    {{ $slot }}
</div>
