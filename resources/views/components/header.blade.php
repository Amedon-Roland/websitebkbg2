{{-- filepath: resources/views/components/header.blade.php --}}
<header id="main-header" class="bg-base-100 sticky top-0 z-50 transition-all duration-300">
    <div class="container mx-auto flex items-center justify-between h-full py-2 px-4 lg:px-8">
        {{-- Logo --}}
        <div class="flex items-center">
            <img src="{{ asset('images/logobkbg.png') }}" alt="Logo" class="h-[50px] lg:h-[80px] w-auto transition-all duration-300">
        </div>

        {{-- Navigation --}}
        <nav class="hidden lg:flex gap-6">
            <a wire:navigate href="{{ route('acceuil') }}" class="text-base-content font-poppins font-medium hover:text-secondary transition-colors {{ request()->routeIs('acceuil') ? 'text-secondary font-bold' : '' }}">Accueil</a>
            <a wire:navigate href="{{ route('explorer') }}" class="text-base-content font-poppins font-medium hover:text-secondary transition-colors {{ request()->routeIs('explorer') ? 'text-secondary font-bold' : '' }}">Explorer</a>
            <a wire:navigate href="{{ route('chambres') }}" class="text-base-content font-poppins font-medium hover:text-secondary transition-colors {{ request()->routeIs('chambres') ? 'text-secondary font-bold' : '' }}">Chambres</a>
            <a wire:navigate href="{{ route('about') }}" class="text-base-content font-poppins font-medium hover:text-secondary transition-colors {{ request()->routeIs('about') ? 'text-secondary font-bold' : '' }}">À propos</a>
            <a wire:navigate href="{{ route('contact') }}" class="text-base-content font-poppins font-medium hover:text-secondary transition-colors {{ request()->routeIs('contact') ? 'text-secondary font-bold' : '' }}">Contacts</a>
        </nav>

        {{-- Bouton --}}
        <div class="hidden lg:block">
            <x-button>Réservez ! </x-button>
        </div>

        {{-- Menu mobile --}}
        <div class="lg:hidden">
            <button id="mobile-menu-toggle" class="btn btn-ghost text-secondary focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Menu mobile (caché par défaut) --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-base-100 shadow-lg">
        <nav class="flex flex-col gap-4 p-4">
            <a wire:navigate href="{{ route('acceuil') }}" class="text-base-content hover:text-secondary transition-colors {{ request()->routeIs('acceuil') ? 'text-secondary font-bold' : '' }}">Accueil</a>
            <a wire:navigate href="{{ route('explorer') }}" class="text-base-content hover:text-secondary transition-colors {{ request()->routeIs('explorer') ? 'text-secondary font-bold' : '' }}">Explorer</a>
            <a wire:navigate href="{{ route('chambres') }}" class="text-base-content hover:text-secondary transition-colors {{ request()->routeIs('chambres') ? 'text-secondary font-bold' : '' }}">Chambres</a>
            <a wire:navigate href="{{ route('about') }}" class="text-base-content hover:text-secondary transition-colors {{ request()->routeIs('about') ? 'text-secondary font-bold' : '' }}">À propos</a>
            <a wire:navigate href="{{ route('contact') }}" class="text-base-content hover:text-secondary transition-colors {{ request()->routeIs('contact') ? 'text-secondary font-bold' : '' }}">Contacts</a>
            <div class="mt-2">
                <x-button width="100%">Réservez ! </x-button>
            </div>
        </nav>
    </div>

    {{-- Script pour le menu mobile et l'effet de scroll --}}
    <script>
        // Fonction qui initialise le menu mobile
        function initMobileMenu() {
            const menuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuToggle && mobileMenu) {
                // Retirer les anciens event listeners pour éviter les doublons
                menuToggle.removeEventListener('click', toggleMobileMenu);
                // Ajouter le nouvel event listener
                menuToggle.addEventListener('click', toggleMobileMenu);
            }
        }

        // Fonction pour basculer la visibilité du menu
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu) {
                mobileMenu.classList.toggle('hidden');
            }
        }

        // Fonction pour gérer l'effet de sticky header au scroll
        function handleScroll() {
            const header = document.getElementById('main-header');
            const scrollPosition = window.scrollY;
            
            if (scrollPosition > 10) {
                header.classList.add('shadow-lg', 'bg-base-100/80', 'backdrop-blur-[2px]');
                header.classList.remove('shadow-sm');
                
                // Rendre le header plus compact en scroll
                if (window.innerWidth >= 1024) { // seulement sur desktop
                    header.style.height = '80px';
                } else {
                    header.style.height = '60px';
                }
            } else {
                header.classList.remove('shadow-lg', 'bg-base-100/80', 'backdrop-blur-[2px]');
                header.classList.add('shadow-sm');
                
                // Rétablir la taille normale
                if (window.innerWidth >= 1024) {
                    header.style.height = '120px';
                } else {
                    header.style.height = 'auto';
                }
            }
        }

        // Initialiser au chargement initial de la page
        document.addEventListener('DOMContentLoaded', () => {
            initMobileMenu();
            handleScroll(); // Appliquer l'état initial
            window.addEventListener('scroll', handleScroll);
        });

        // Réinitialiser après chaque navigation avec Livewire
        document.addEventListener('livewire:navigated', () => {
            initMobileMenu();
            handleScroll();
        });
    </script>
</header>
