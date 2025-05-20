{{-- filepath: resources/views/components/header.blade.php --}}
<header id="main-header" class="sticky top-0 z-50 transition-all duration-300 bg-base-100 shadow-sm">
    <div class="container mx-auto flex items-center justify-between h-full px-4 lg:px-8">
        {{-- Logo avec animation subtile --}}
        <div class="flex items-center py-2 md:py-3">
            <a href="{{ route('acceuil') }}" class="transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('images/logobkbg.png') }}" alt="Logo BKBG" class="h-[45px] lg:h-[70px] w-auto transition-all duration-300">
            </a>
        </div>

        {{-- Navigation Desktop avec effets modernes --}}
        <nav class="hidden lg:flex items-center">
            <div class="flex gap-1 xl:gap-2 p-1 rounded-full bg-base-200/50 backdrop-blur-sm">
                <a wire:navigate href="{{ route('acceuil') }}" 
                   class="px-4 py-2 rounded-full transition-all duration-200 font-poppins text-sm xl:text-base
                          {{ request()->routeIs('acceuil') 
                                ? 'bg-secondary text-white font-semibold shadow-md' 
                                : 'hover:bg-base-300/70 text-base-content' }}">
                    Accueil
                </a>
                <a wire:navigate href="{{ route('explorer') }}" 
                   class="px-4 py-2 rounded-full transition-all duration-200 font-poppins text-sm xl:text-base
                          {{ request()->routeIs('explorer') 
                                ? 'bg-secondary text-white font-semibold shadow-md' 
                                : 'hover:bg-base-300/70 text-base-content' }}">
                    Explorer
                </a>
                <a wire:navigate href="{{ route('chambres') }}" 
                   class="px-4 py-2 rounded-full transition-all duration-200 font-poppins text-sm xl:text-base
                          {{ request()->routeIs('chambres') 
                                ? 'bg-secondary text-white font-semibold shadow-md' 
                                : 'hover:bg-base-300/70 text-base-content' }}">
                    Chambres
                </a>
                <a wire:navigate href="{{ route('about') }}" 
                   class="px-4 py-2 rounded-full transition-all duration-200 font-poppins text-sm xl:text-base
                          {{ request()->routeIs('about') 
                                ? 'bg-secondary text-white font-semibold shadow-md' 
                                : 'hover:bg-base-300/70 text-base-content' }}">
                    À propos
                </a>
                <a wire:navigate href="{{ route('contact') }}" 
                   class="px-4 py-2 rounded-full transition-all duration-200 font-poppins text-sm xl:text-base
                          {{ request()->routeIs('contact') 
                                ? 'bg-secondary text-white font-semibold shadow-md' 
                                : 'hover:bg-base-300/70 text-base-content' }}">
                    Contacts
                </a>
            </div>
        </nav>

        {{-- Bouton de réservation et menu mobile --}}
        <div class="flex items-center gap-2">
            {{-- Bouton de réservation (desktop) --}}
            <div class="hidden lg:block">
                <div class="relative group">
                    <div class="absolute  bg-primary rounded-full"></div>
                    <x-button class="relative">
                        <span class="mr-1">Réservez</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </x-button>
                </div>
            </div>
            
           

            {{-- Bouton du menu mobile avec animation --}}
            <div class="lg:hidden">
                <button id="mobile-menu-toggle" class="btn btn-circle btn-ghost text-secondary">
                    <span class="sr-only">Menu</span>
                    <svg id="menu-icon-bars" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 transition-opacity duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg id="menu-icon-close" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 absolute opacity-0 transition-opacity duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu mobile moderne avec animation --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-base-100 shadow-lg overflow-hidden transition-all duration-300 max-h-0">
        <nav class="flex flex-col gap-3 px-5 pb-5">
            <a wire:navigate href="{{ route('acceuil') }}" 
               class="py-3 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('acceuil') ? 'bg-secondary/10 text-secondary font-bold' : 'hover:bg-base-200 text-base-content' }}">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Accueil
                </div>
            </a>
            <a wire:navigate href="{{ route('explorer') }}" 
               class="py-3 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('explorer') ? 'bg-secondary/10 text-secondary font-bold' : 'hover:bg-base-200 text-base-content' }}">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                    Explorer
                </div>
            </a>
            <a wire:navigate href="{{ route('chambres') }}" 
               class="py-3 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('chambres') ? 'bg-secondary/10 text-secondary font-bold' : 'hover:bg-base-200 text-base-content' }}">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Chambres
                </div>
            </a>
            <a wire:navigate href="{{ route('about') }}" 
               class="py-3 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('about') ? 'bg-secondary/10 text-secondary font-bold' : 'hover:bg-base-200 text-base-content' }}">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    À propos
                </div>
            </a>
            <a wire:navigate href="{{ route('contact') }}" 
               class="py-3 px-4 rounded-lg transition-all duration-200 {{ request()->routeIs('contact') ? 'bg-secondary/10 text-secondary font-bold' : 'hover:bg-base-200 text-base-content' }}">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                    Contacts
                </div>
            </a>
            <div class="mt-3 border-t border-base-200 pt-4">
                <x-button width="100%" class="btn-lg justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    Réservez maintenant
                </x-button>
            </div>
        </nav>
    </div>

    {{-- Script pour le menu mobile et l'effet de scroll amélioré --}}
    <script>
        // Fonction qui initialise le menu mobile avec animations
        function initMobileMenu() {
            const menuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIconBars = document.getElementById('menu-icon-bars');
            const menuIconClose = document.getElementById('menu-icon-close');

            if (menuToggle && mobileMenu) {
                // Retirer les anciens event listeners pour éviter les doublons
                menuToggle.removeEventListener('click', toggleMobileMenu);
                // Ajouter le nouvel event listener
                menuToggle.addEventListener('click', toggleMobileMenu);
            }
        }

        // Fonction pour basculer la visibilité du menu avec animation
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIconBars = document.getElementById('menu-icon-bars');
            const menuIconClose = document.getElementById('menu-icon-close');
            
            if (mobileMenu) {
                if (mobileMenu.classList.contains('hidden')) {
                    // Ouvrir le menu
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.style.maxHeight = '0px';
                    
                    // Animation d'icône
                    menuIconBars.classList.add('opacity-0');
                    menuIconClose.classList.remove('opacity-0');
                    
                    // Déclencher l'animation après un court délai pour permettre la transition
                    setTimeout(() => {
                        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                    }, 10);
                } else {
                    // Fermer le menu
                    mobileMenu.style.maxHeight = '0px';
                    
                    // Animation d'icône
                    menuIconBars.classList.remove('opacity-0');
                    menuIconClose.classList.add('opacity-0');
                    
                    // Cacher complètement après la fin de l'animation
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                    }, 300); // Correspond à la durée de transition
                }
            }
        }

        // Fonction pour gérer l'effet de sticky header au scroll avec animation fluide
        function handleScroll() {
            const header = document.getElementById('main-header');
            const scrollPosition = window.scrollY;
            const logo = header.querySelector('img');
            
            if (scrollPosition > 10) {
                header.classList.add('shadow-lg', 'bg-base-100/90', 'backdrop-blur-sm');
                header.classList.remove('shadow-sm');
                
                // Rendre le header plus compact en scroll avec animation fluide
                if (window.innerWidth >= 1024) { // seulement sur desktop
                    header.style.height = '80px';
                    if (logo) logo.style.height = '50px';
                } else {
                    header.style.height = '60px';
                    if (logo) logo.style.height = '35px';
                }
            } else {
                header.classList.remove('shadow-lg', 'bg-base-100/90', 'backdrop-blur-sm');
                header.classList.add('shadow-sm');
                
                // Rétablir la taille normale avec animation fluide
                if (window.innerWidth >= 1024) {
                    header.style.height = '100px';
                    if (logo) logo.style.height = '70px';
                } else {
                    header.style.height = 'auto';
                    if (logo) logo.style.height = '45px';
                }
            }
        }

        // Initialiser au chargement initial de la page
        document.addEventListener('DOMContentLoaded', () => {
            initMobileMenu();
            handleScroll(); // Appliquer l'état initial
            window.addEventListener('scroll', handleScroll);
            window.addEventListener('resize', handleScroll);
        });

        // Réinitialiser après chaque navigation avec Livewire
        document.addEventListener('livewire:navigated', () => {
            initMobileMenu();
            handleScroll();
        });
    </script>
</header>
