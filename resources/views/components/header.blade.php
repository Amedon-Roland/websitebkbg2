{{-- filepath: resources/views/components/header.blade.php --}}
<header class="bg-white shadow-md lg:h-[120px]">
    <div class="container mx-auto flex items-center justify-between h-full py-2 px-4 lg:px-8">
        {{-- Logo --}}
        <div class="flex items-center">
            <img src="{{ asset('images/logobkbg.png') }}" alt="Logo" class="h-[50px] lg:h-[80px] w-auto">
        </div>

        {{-- Navigation --}}
        <nav class="hidden lg:flex gap-6">
            <a href="{{ route('acceuil') }}" class="text-black font-poppins font-medium hover:text-secondary {{ request()->routeIs('acceuil') ? 'text-secondary font-bold' : '' }}">Accueil</a>
            <a href="{{ route('explorer') }}" class="text-black font-poppins font-medium hover:text-secondary {{ request()->routeIs('explorer') ? 'text-secondary font-bold' : '' }}">Explorer</a>
            <a href="{{ route('chambres') }}" class="text-black font-poppins font-medium hover:text-secondary {{ request()->routeIs('chambres') ? 'text-secondary font-bold' : '' }}">Chambres</a>
            <a href="{{ route('about') }}" class="text-black font-poppins font-medium hover:text-secondary {{ request()->routeIs('about') ? 'text-secondary font-bold' : '' }}">À propos</a>
            <a href="{{ route('contact') }}" class="text-black font-poppins font-medium hover:text-secondary {{ request()->routeIs('contact') ? 'text-secondary font-bold' : '' }}">Contacts</a>
        </nav>

        {{-- Bouton --}}
        <div class="hidden lg:block">
            <x-button>Réservez ! </x-button>
        </div>

        {{-- Menu mobile --}}
        <div class="lg:hidden">
            <button id="mobile-menu-toggle" class="text-secondary focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Menu mobile (caché par défaut) --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-white shadow-md">
        <nav class="flex flex-col gap-4 p-4">
            <a href="{{ route('acceuil') }}" class="text-gray-600 hover:text-secondary {{ request()->routeIs('acceuil') ? 'text-secondary font-bold' : '' }}">Accueil</a>
            <a href="{{ route('explorer') }}" class="text-gray-600 hover:text-secondary {{ request()->routeIs('explorer') ? 'text-secondary font-bold' : '' }}">Explorer</a>
            <a href="{{ route('chambres') }}" class="text-gray-600 hover:text-secondary {{ request()->routeIs('chambres') ? 'text-secondary font-bold' : '' }}">Chambres</a>
            <a href="{{ route('about') }}" class="text-gray-600 hover:text-secondary {{ request()->routeIs('about') ? 'text-secondary font-bold' : '' }}">À propos</a>
            <a href="{{ route('contact') }}" class="text-gray-600 hover:text-secondary {{ request()->routeIs('contact') ? 'text-secondary font-bold' : '' }}">Contacts</a>
            <div class="mt-2">
                <x-button width="100%">Réservez ! </x-button>
            </div>
        </nav>
    </div>

    {{-- Script pour le menu mobile --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            menuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
</header>
