{{-- filepath: resources/views/components/profile-card.blade.php --}}
{{--
    Composant : Profile Card
    Description : Affiche une carte de profil avec une image, un cadre rouge en arrière-plan, et un texte descriptif (nom et rôle).
    Props :
        - $image (string) : URL de l'image de profil.
        - $name (string) : Nom de la personne.
        - $role (string) : Rôle ou titre de la personne.
    Exemple d'utilisation :
        <x-profile-card
            image="{{ asset('images/manager.jpg') }}"
            name="Chidinma James"
            role="Manager"
        />
--}}
<div class="relative w-[458px] h-[513px] flex flex-col items-center">
    {{-- Red Background Frame --}}
    <div class="absolute bottom-6 left-6 w-[458px] h-[513px] bg-primary"></div>

    {{-- Profile Image --}}
    <img src="{{ $image }}" alt="{{ $name }}" class="relative w-[458px] h-[513px] object-cover shadow-md">

    {{-- Name and Role --}}
    <div class="mt-4 text-center font-mulish">
        <p class="text-lg font-bold text-black">{{ $name }}</p>
        <p class="text-sm text-black">{{ $role }}</p>
    </div>
</div>
