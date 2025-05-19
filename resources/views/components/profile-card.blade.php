{{-- filepath: resources/views/components/profile-card.blade.php --}}
{{--
    Composant : Profile Card
    Description : Affiche une carte de profil avec une image, un cadre d'accent en arrière-plan, et un texte descriptif.
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
<div class="w-full max-w-sm mx-auto relative group">
    {{-- Card Container with Frame Effect --}}
    <div class="relative aspect-[4/5] mb-16">
        {{-- Background Frame with Animation --}}
        <div class="absolute bottom-0 right-0 w-[90%] h-[90%] bg-primary/90 transform translate-x-4 translate-y-4 rounded-lg transition-all duration-300 group-hover:translate-x-3 group-hover:translate-y-3 group-hover:shadow-xl z-0"></div>
        
        {{-- Profile Image Container --}}
        <div class="absolute inset-0 bg-base-100 shadow-lg rounded-lg overflow-hidden z-10">
            <img 
                src="{{ $image }}" 
                alt="{{ $name }}" 
                class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
            >
            
            {{-- Image Overlay Gradient --}}
            <div class="absolute bottom-0 left-0 right-0 h-1/3 bg-gradient-to-t from-black/70 to-transparent opacity-60"></div>
        </div>
        
        {{-- Social Media Icons (Optional) --}}
        <div class="absolute top-3 right-3 flex gap-2 z-20 opacity-0 transform -translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
            <a href="#" class="w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors duration-300 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>
            <a href="#" class="w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors duration-300 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                    <path d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814 11.874 11.874 0 0 1-8.62-4.37 4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101 4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65a8.394 8.394 0 0 1-6.191 1.732 11.83 11.83 0 0 0 6.41 1.88c7.693 0 11.9-6.373 11.9-11.9 0-.18-.005-.362-.013-.54a8.496 8.496 0 0 0 2.087-2.165z"/>
                </svg>
            </a>
            <a href="#" class="w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors duration-300 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
            </a>
        </div>
    </div>
    
    {{-- Name and Role Info Card --}}
    <div class="bg-white shadow-lg rounded-lg p-5 -mt-12 mx-4 relative z-20 text-center transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-1">{{ $name }}</h3>
        <p class="text-sm text-primary font-medium mb-2">{{ $role }}</p>
        
        {{-- Divider --}}
        <div class="w-12 h-0.5 bg-primary/30 mx-auto my-2"></div>
        
        {{-- Short Bio (Optional) --}}
        <p class="text-xs sm:text-sm text-gray-600 line-clamp-3 mt-2">
            Expert en hospitalité avec plus de 10 ans d'expérience dans le secteur du luxe. Passionné par l'excellence du service client et l'innovation.
        </p>
    </div>
</div>

