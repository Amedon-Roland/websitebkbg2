@extends('layout')

@section('content')

<x-image-hero-section
    backgroundImage="{{ asset('images/treehero.jpg') }}"
    title="À propos de BKBG"
    description="Découvrez notre histoire, notre mission et les personnes qui font de BKBG un lieu d'exception au cœur de l'hospitalité de luxe."
    :showScrollButton="true"
/>

{{-- Section Introduction avec animation au scroll --}}
<div class="container mx-auto px-4 sm:px-6 py-8 md:py-16">
    <div class="max-w-4xl mx-auto text-center mb-12">
        <h2 class="text-xs sm:text-sm font-medium text-primary uppercase tracking-wider mb-2 sm:mb-3">Notre Histoire</h2>
        <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4 sm:mb-6">Une aventure qui a commencé en 2010</h3>
        <div class="w-16 sm:w-20 h-1 bg-primary mx-auto mb-4 sm:mb-6 rounded-full"></div>
        <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed px-2">
            BKBG a été fondé avec une vision claire : créer un espace d'exception où le confort rencontre l'élégance, où chaque client se sent comme chez lui tout en vivant une expérience unique au cœur de la capitale.
        </p>
    </div>
    
    <div class="grid grid-cols-1 gap-6 sm:gap-8 mt-8 sm:mt-12">
        <div class="card bg-base-100 hover:shadow-xl transition-all duration-300 border border-base-200">
            <div class="card-body items-center text-center">
                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Notre Mission</h3>
                <p class="text-gray-600">Offrir un service d'hébergement exceptionnel qui dépasse les attentes de nos clients tout en préservant l'authenticité locale.</p>
            </div>
        </div>
        
        <div class="card bg-base-100 hover:shadow-xl transition-all duration-300 border border-base-200">
            <div class="card-body items-center text-center">
                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Notre Vision</h3>
                <p class="text-gray-600">Devenir la référence en matière d'hébergement de qualité, reconnu pour notre service personnalisé et notre atmosphère unique.</p>
            </div>
        </div>
        
        <div class="card bg-base-100 hover:shadow-xl transition-all duration-300 border border-base-200">
            <div class="card-body items-center text-center">
                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Nos Valeurs</h3>
                <p class="text-gray-600">Excellence, authenticité, respect et innovation guident chaque aspect de notre service et de notre relation avec nos clients.</p>
            </div>
        </div>
    </div>
</div>

{{-- Section Statistiques avec fond contrasté --}}
<div class="bg-base-200 py-8 sm:py-12 md:py-16">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
            <div class="stat p-3 sm:p-4">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div class="stat-value text-xl sm:text-2xl md:text-3xl font-bold text-primary">15000+</div>
                <div class="stat-title text-xs sm:text-sm md:text-base">Clients satisfaits</div>
            </div>
            
            <div class="stat p-4">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                </div>
                <div class="stat-value text-2xl md:text-3xl font-bold text-primary">50+</div>
                <div class="stat-title text-sm md:text-base">Chambres de luxe</div>
            </div>
            
            <div class="stat p-4">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                    </svg>
                </div>
                <div class="stat-value text-2xl md:text-3xl font-bold text-primary">98%</div>
                <div class="stat-title text-sm md:text-base">Taux satisfaction</div>
            </div>
            
            <div class="stat p-4">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-value text-2xl md:text-3xl font-bold text-primary">13</div>
                <div class="stat-title text-sm md:text-base">Années d'expérience</div>
            </div>
        </div>
    </div>
</div>

{{-- Section Équipe --}}
<div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 md:py-20">
    <div class="text-center mb-8 sm:mb-12">
        <h2 class="text-xs sm:text-sm font-medium text-primary uppercase tracking-wider mb-2 sm:mb-3">Notre Équipe</h2>
        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-6">Les personnes derrière BKBG</h3>
        <div class="w-16 sm:w-20 h-1 bg-primary mx-auto mb-4 sm:mb-6 rounded-full"></div>
        <p class="text-sm sm:text-base md:text-lg text-gray-600 max-w-3xl mx-auto px-2">
            Notre équipe passionnée travaille sans relâche pour vous offrir une expérience inoubliable. Découvrez les visages qui font de BKBG un lieu si spécial.
        </p>
    </div>
    
    <div class="flex flex-col lg:flex-row gap-6 sm:gap-8 items-center lg:items-start">
        {{-- Profile Card Column --}}
        <div class="w-full sm:w-4/5 md:w-3/4 lg:w-5/12 mx-auto lg:mx-0">
            <x-profile-card 
                image="{{ asset('images/im.jpg') }}" 
                name="Chidinma James" 
                role="Directrice Générale" 
            />
            
            <div class="mt-6 sm:mt-8 p-4 sm:p-6 bg-base-100 rounded-xl shadow-md">
                <h4 class="text-base sm:text-lg font-bold mb-2 sm:mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    Un mot de notre directrice
                </h4>
                <blockquote class="italic text-sm sm:text-base text-gray-600 border-l-4 border-primary pl-3 sm:pl-4">
                    "Notre mission est de créer un environnement où chaque client se sent spécial. Nous ne vendons pas simplement des nuitées, nous créons des souvenirs qui durent toute une vie."
                </blockquote>
            </div>
        </div>

        {{-- Text Content Column --}}
        <div class="w-full lg:w-7/12 mt-6 lg:mt-0">
            <div class="font-mulish text-sm sm:text-base leading-relaxed space-y-4 sm:space-y-6 text-gray-700">
                <p>
                    Chez BKBG, nous croyons fermement que le succès d'un établissement repose sur la qualité de son personnel. Notre équipe, dirigée par Chidinma James, est composée de professionnels passionnés par l'hospitalité et dévoués à offrir un service d'exception.
                </p>
                <p>
                    Avec plus de 15 ans d'expérience dans l'industrie hôtelière, Chidinma a bâti BKBG sur des principes solides : attention aux détails, service personnalisé et ambiance chaleureuse. Son parcours international lui a permis d'acquérir une vision unique de l'hospitalité, qu'elle a su transmettre à toute l'équipe.
                </p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 my-6 sm:my-8">
                    <div class="flex gap-2 sm:gap-3 items-start">
                        <div class="rounded-full bg-primary/10 p-1.5 sm:p-2 mt-0.5 sm:mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="font-bold text-sm sm:text-base">Formation continue</h5>
                            <p class="text-xs sm:text-sm text-gray-600">Notre personnel bénéficie de formations régulières pour améliorer ses compétences.</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 sm:gap-3 items-start">
                        <div class="rounded-full bg-primary/10 p-1.5 sm:p-2 mt-0.5 sm:mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="font-bold text-sm sm:text-base">Service 24/7</h5>
                            <p class="text-xs sm:text-sm text-gray-600">Notre équipe est disponible à tout moment pour répondre à vos besoins.</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 sm:gap-3 items-start">
                        <div class="rounded-full bg-primary/10 p-1.5 sm:p-2 mt-0.5 sm:mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="font-bold text-sm sm:text-base">Expertise locale</h5>
                            <p class="text-xs sm:text-sm text-gray-600">Nos conseillers connaissent parfaitement la région pour vous guider.</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 sm:gap-3 items-start">
                        <div class="rounded-full bg-primary/10 p-1.5 sm:p-2 mt-0.5 sm:mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="font-bold text-sm sm:text-base">Personnalisation</h5>
                            <p class="text-xs sm:text-sm text-gray-600">Chaque séjour est adapté aux préférences spécifiques de nos clients.</p>
                        </div>
                    </div>
                </div>
                
                <p>
                    Notre équipe est composée de 25 membres dévoués, chacun apportant son expertise unique. Du personnel d'accueil chaleureux aux chefs talentueux, en passant par notre équipe d'entretien méticuleuse, chaque personne joue un rôle crucial dans la création d'une expérience exceptionnelle pour nos hôtes.
                </p>
                <p>
                    Nous investissons continuellement dans le développement professionnel de notre équipe, car nous croyons qu'un personnel heureux et épanoui est la clé d'un service client exceptionnel. Cette philosophie nous a permis de maintenir un taux de satisfaction client de 98% et un taux de fidélisation remarquable.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Section Clients avec animation --}}
<div class="bg-base-200 py-8 sm:py-12 md:py-16">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-6 sm:mb-10">
            <h2 class="text-xs sm:text-sm font-medium text-primary uppercase tracking-wider mb-2 sm:mb-3">Ils nous font confiance</h2>
            <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-6">Nos Partenaires et Clients</h3>
            <div class="w-16 sm:w-20 h-1 bg-primary mx-auto mb-4 sm:mb-6 rounded-full"></div>
        </div>
        
        <div class="px-2 sm:px-6 md:px-12 lg:px-24">
            <div class="client-carousel overflow-hidden">
                <x-client-list :image-links="['/images/ncc.png', '/images/nirsal.png', '/images/nncp.png', '/images/unicef.png', '/images/ccofnageria.png']" />
            </div>
        </div>
    </div>
</div>

{{-- Section CTA --}}
<div class="container mx-auto px-4 sm:px-6 py-10 sm:py-16 md:py-24">
    <div class="bg-primary text-white rounded-lg sm:rounded-xl md:rounded-3xl p-6 sm:p-8 md:p-12 relative overflow-hidden shadow-xl">
        <div class="absolute top-0 right-0 w-32 sm:w-48 md:w-64 h-32 sm:h-48 md:h-64 -mt-8 sm:-mt-12 md:-mt-16 -mr-8 sm:-mr-12 md:-mr-16 bg-white/10 rounded-full blur-xl sm:blur-2xl md:blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-32 sm:w-48 md:w-64 h-32 sm:h-48 md:h-64 -mb-8 sm:-mb-12 md:-mb-16 -ml-8 sm:-ml-12 md:-ml-16 bg-white/10 rounded-full blur-xl sm:blur-2xl md:blur-3xl"></div>
        
        <div class="relative z-10 max-w-3xl mx-auto text-center">
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-3 sm:mb-4">Prêt à vivre l'expérience BKBG?</h2>
            <p class="text-white/80 text-sm sm:text-base md:text-lg mb-6 sm:mb-8">
                Réservez dès maintenant et commencez à créer des souvenirs inoubliables dans notre établissement exceptionnel.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                <a href="{{ route('chambres') }}" class="btn btn-sm sm:btn-md btn-secondary">
                    Découvrir nos chambres
                </a>
                <a href="{{ route('contact') }}" class="btn btn-sm sm:btn-md btn-outline border-white text-white hover:bg-white hover:text-primary">
                    Nous contacter
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Script pour animations --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation au scroll pour les éléments
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.stat, .card, .grid > div');
            elements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                const elementBottom = el.getBoundingClientRect().bottom;
                const windowHeight = window.innerHeight;
                
                // Seuil ajusté pour les mobiles
                const threshold = window.innerWidth < 640 ? 50 : 100;
                
                if (elementTop < windowHeight - threshold && elementBottom > 0) {
                    el.classList.add('animate-fadeIn');
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Style initial pour les éléments à animer
        const elementsToAnimate = document.querySelectorAll('.stat, .card, .grid > div');
        elementsToAnimate.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        });
        
        // Animation du client carousel optimisée pour mobile
        const clientCarousel = document.querySelector('.client-carousel');
        if (clientCarousel) {
            clientCarousel.style.overflow = 'hidden';
            const clientList = clientCarousel.querySelector('div');
            if (clientList) {
                // Duplication des éléments pour un défilement continu
                clientList.innerHTML = clientList.innerHTML + clientList.innerHTML;
                // Vitesse d'animation adaptée selon la taille d'écran
                const duration = window.innerWidth < 640 ? '20s' : '30s';
                clientList.style.animation = `scroll ${duration} linear infinite`;
                // Adapter la largeur pour mobile
                clientList.style.display = 'flex';
                clientList.style.flexWrap = 'nowrap';
                
                // Ajuster les images du carousel pour mobile
                const images = clientList.querySelectorAll('img');
                images.forEach(img => {
                    img.style.width = 'auto';
                    img.style.height = window.innerWidth < 640 ? '40px' : '60px';
                    img.style.margin = window.innerWidth < 640 ? '0 10px' : '0 20px';
                    img.style.objectFit = 'contain';
                });
            }
        }
        
        // Appliquer les animations au chargement et au scroll
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('resize', animateOnScroll);
        setTimeout(animateOnScroll, 100); // Déclenchement initial
        
        // Réinitialisations sur redimensionnement
        window.addEventListener('resize', function() {
            if (clientCarousel) {
                const clientList = clientCarousel.querySelector('div');
                if (clientList) {
                    const duration = window.innerWidth < 640 ? '20s' : '30s';
                    clientList.style.animation = `scroll ${duration} linear infinite`;
                    
                    const images = clientList.querySelectorAll('img');
                    images.forEach(img => {
                        img.style.height = window.innerWidth < 640 ? '40px' : '60px';
                        img.style.margin = window.innerWidth < 640 ? '0 10px' : '0 20px';
                    });
                }
            }
        });
    });
</script>

<style>
    /* CSS optimisé pour une meilleure responsivité */
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.6s ease-out forwards;
    }
    
    /* Ajout d'une classe xs pour les très petits écrans */
    @media (min-width: 475px) {
        .xs\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    
    /* Améliorations pour les images dans le carousel */
    .client-carousel img {
        transition: all 0.3s ease;
        filter: grayscale(100%);
        opacity: 0.7;
    }
    
    .client-carousel img:hover {
        filter: grayscale(0);
        opacity: 1;
    }
</style>

@endsection