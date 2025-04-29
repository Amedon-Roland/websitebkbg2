{{-- filepath: resources/views/components/footer.blade.php --}}
<footer class="bg-secondary text-white w-full overflow-hidden">
    {{-- Version Mobile (visible uniquement sur mobile) --}}
    <div class="lg:hidden px-4 sm:px-8 py-8 sm:py-10">
        {{-- Newsletter (premier élément en mobile) --}}
        <div class="mb-8 sm:mb-10">
            <h3 class="font-bold text-lg mb-3">Newsletter</h3>
            <p class="text-sm mb-4 sm:mb-5">
                Veuillez vous abonner à notre newsletter pour recevoir les dernières offres sur nos chambres et nos vacances à prix réduit.
            </p>
            <form action="#" method="POST" class="flex flex-col">
                <div class="flex items-center overflow-hidden rounded-md bg-white w-full">
                    <input type="email" placeholder="Entrer votre email" class="flex-grow focus:outline-none bg-white p-3 pl-4 text-black w-full">
                    <button type="submit" class="bg-[#0C4E99] text-white px-4 sm:px-6 py-3 whitespace-nowrap">S'abonner</button>
                </div>
            </form>
        </div>

        {{-- Liens pour mobile et tablette --}}
        <div class="sm:flex sm:flex-wrap sm:justify-between">
            {{-- Deux colonnes pour les liens sur mobile, flex row sur tablette --}}
            <div class="grid grid-cols-2 gap-4 sm:gap-8 mb-8 sm:mb-10 w-full sm:flex sm:flex-row sm:justify-start">
                {{-- Liens rapides --}}
                <div class="pl-1 sm:w-1/4 sm:mr-4">
                    <h3 class="font-bold text-lg mb-3">Liens rapides</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm hover:underline">Réservation de salle</a></li>
                        <li><a href="#" class="text-sm hover:underline">Chambres</a></li>
                        <li><a href="#" class="text-sm hover:underline">Contact</a></li>
                        <li><a href="#" class="text-sm hover:underline">Explorer</a></li>
                    </ul>
                </div>

                {{-- Entreprise --}}
                <div class="pl-1 sm:w-1/4 sm:mr-4">
                    <h3 class="font-bold text-lg mb-3">Entreprise</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm hover:underline">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-sm hover:underline">Politique de remboursement</a></li>
                        <li><a href="#" class="text-sm hover:underline">F.A.Q</a></li>
                        <li><a href="#" class="text-sm hover:underline">À propos</a></li>
                    </ul>
                </div>
            </div>

            {{-- Réseaux sociaux --}}
            <div class="mb-10 pl-1 sm:w-1/4 sm:mr-4">
                <h3 class="font-bold text-lg mb-3">Réseaux sociaux</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-sm hover:underline">Facebook</a></li>
                    <li><a href="#" class="text-sm hover:underline">Twitter</a></li>
                    <li><a href="#" class="text-sm hover:underline">Instagram</a></li>
                    <li><a href="#" class="text-sm hover:underline">LinkedIn</a></li>
                </ul>
            </div>
        </div>

        {{-- Be Kind Be Generous --}}
        <div class="text-center mb-4 pt-2">
            <p class="font-dancing text-3xl italic">Be Kind Be Generous</p>
        </div>

        {{-- Copyright --}}
        <div class="text-center text-xs pt-1 pb-2">
            <p>BKBG (RolandTech-hatandamso) 2025</p>
        </div>
    </div>

        {{-- Version Desktop (visible uniquement sur desktop) --}}
        <div class="hidden lg:block w-full">
            <div class="container mx-auto flex flex-wrap items-start justify-between py-10 px-8 md:px-12 gap-6 lg:gap-4 h-full custom-footer-desktop">
                {{-- Footer Title --}}
                <div class="flex-shrink-0 md:w-1/4 lg:w-1/5">
                    <x-footer-title/>
                </div>
    
                {{-- Liens rapides --}}
                <div class="flex-1 pl-2 min-w-[150px]">
                    <h3 class="font-bold text-lg mb-5">Liens rapides</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:underline">Réservation de salle</a></li>
                        <li><a href="#" class="hover:underline">Chambres</a></li>
                        <li><a href="#" class="hover:underline">Contact</a></li>
                        <li><a href="#" class="hover:underline">Explorer</a></li>
                    </ul>
                </div>
    
                {{-- Entreprise --}}
                <div class="flex-1 pl-2 min-w-[150px]">
                    <h3 class="font-bold text-lg mb-5">Entreprise</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:underline">Politique de confidentialité</a></li>
                        <li><a href="#" class="hover:underline">Politique de remboursement</a></li>
                        <li><a href="#" class="hover:underline">F.A.Q</a></li>
                        <li><a href="#" class="hover:underline">À propos</a></li>
                    </ul>
                </div>
    
                {{-- Réseaux sociaux --}}
                <div class="flex-1 pl-2 min-w-[150px]">
                    <h3 class="font-bold text-lg mb-5">Réseaux sociaux</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:underline">Facebook</a></li>
                        <li><a href="#" class="hover:underline">Twitter</a></li>
                        <li><a href="#" class="hover:underline">Instagram</a></li>
                        <li><a href="#" class="hover:underline">LinkedIn</a></li>
                    </ul>
                </div>
    
                {{-- Newsletter --}}
                <div class="flex-1 pl-2 lg:max-w-xs xl:max-w-sm">
                    <h3 class="font-bold text-lg mb-5">Newsletter</h3>
                    <p class="text-sm mb-5">
                        Abonnez-vous à notre newsletter pour recevoir les dernières offres sur nos chambres et nos vacances à prix réduit.
                    </p>
                    <form action="#" method="POST" class="flex items-center newsletter-form">

                        <div class="flex items-center bg-white p-1 rounded-[2.5px] overflow-hidden w-full max-w-full">
                            <input type="email" placeholder="Entrez votre email" class="focus:outline-none bg-white p-3 pl-4 text-black w-full min-w-0">
                            <button type="submit" class="bg-secondary rounded-[2.5px] text-white cursor-pointer whitespace-nowrap px-2 py-2 text-sm">S'abonner</button>
                        </div>
                    </form>
                </div>
            </div>
    
            {{-- Copyright --}}
            <div class="border-t border-white text-center py-6">
                <p class="text-xs">© 2025 Hotel BKBG</p>
            </div>
        </div>
    </footer>
    
    {{-- Ajoute ce CSS soit dans ton fichier CSS soit dans ton <style> dans le blade --}}
        <style>
            @media (min-width: 1096px) and (max-width: 1280px) {
                .custom-footer-desktop {
                    flex-wrap: nowrap;
                    justify-content: flex-start;
                    gap: 2rem; /* réduit l'écart entre les colonnes */
                }
                .newsletter-form {
                    flex-direction: column;
                    align-items: stretch;
                    gap: 0.5rem; /* petit espace entre input et bouton */
                }
            }
            </style>
            