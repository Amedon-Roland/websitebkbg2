{{-- filepath: resources/views/components/footer.blade.php --}}
<footer class="bg-secondary text-white">
    {{-- Version Mobile (visible uniquement sur mobile) --}}
    <div class="md:hidden px-8 py-10">
        {{-- Newsletter (premier élément en mobile) --}}
        <div class="mb-10">
            <h3 class="font-bold text-lg mb-3">Newsletter</h3>
            <p class="text-sm mb-5">
                Veuillez vous abonner à notre newsletter pour recevoir les dernières offres sur nos chambres et nos vacances à prix réduit.
            </p>
            <form action="#" method="POST" class="flex flex-col">
                <div class="flex items-center overflow-hidden rounded-md bg-white w-full">
                    <input type="email" placeholder="Entrer votre email" class="flex-grow focus:outline-none bg-white p-3 pl-4 text-black w-full">
                    <button type="submit" class="bg-[#0C4E99] text-white px-6 py-3 whitespace-nowrap">S'abonner</button>
                </div>
            </form>
        </div>

        {{-- Deux colonnes pour les liens --}}
        <div class="grid grid-cols-2 gap-8 mb-10">
            {{-- Liens rapides --}}
            <div class="pl-1">
                <h3 class="font-bold text-lg mb-3">Liens rapides</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-sm">Réservation de salle</a></li>
                    <li><a href="#" class="text-sm">Chambres</a></li>
                    <li><a href="#" class="text-sm">Contact</a></li>
                    <li><a href="#" class="text-sm">Explorer</a></li>
                </ul>
            </div>

            {{-- Entreprise --}}
            <div class="pl-1">
                <h3 class="font-bold text-lg mb-3">Entreprise</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-sm">politique de confidentialité</a></li>
                    <li><a href="#" class="text-sm">Politique de remboursement</a></li>
                    <li><a href="#" class="text-sm">F.A.Q</a></li>
                    <li><a href="#" class="text-sm">À propos</a></li>
                </ul>
            </div>
        </div>

        {{-- Réseaux sociaux --}}
        <div class="mb-14 pl-1">
            <h3 class="font-bold text-lg mb-3">Réseaux sociaux</h3>
            <ul class="space-y-3">
                <li><a href="#" class="text-sm">Facebook</a></li>
                <li><a href="#" class="text-sm">Twitter</a></li>
                <li><a href="#" class="text-sm">Instagram</a></li>
                <li><a href="#" class="text-sm">LinkedIn</a></li>
            </ul>
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
    <div class="hidden md:block">
        <div class="container pt-15 font-raleway mx-auto flex flex-row items-start justify-between py-10 px-8 md:px-12 gap-10 h-full">
            {{-- Footer Title --}}
            <div class="flex-shrink-0 md:w-1/4">
                <x-footer-title/>
            </div>

            {{-- Liens rapides --}}
            <div class="flex-1 pl-2">
                <h3 class="font-bold text-lg mb-5">Liens rapides</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:underline">Réservation de salle</a></li>
                    <li><a href="#" class="hover:underline">Chambres</a></li>
                    <li><a href="#" class="hover:underline">Contact</a></li>
                    <li><a href="#" class="hover:underline">Explorer</a></li>
                </ul>
            </div>

            {{-- Entreprise --}}
            <div class="flex-1 pl-2">
                <h3 class="font-bold text-lg mb-5">Entreprise</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:underline">Politique de confidentialité</a></li>
                    <li><a href="#" class="hover:underline">Politique de remboursement</a></li>
                    <li><a href="#" class="hover:underline">F.A.Q</a></li>
                    <li><a href="#" class="hover:underline">À propos</a></li>
                </ul>
            </div>

            {{-- Réseaux sociaux --}}
            <div class="flex-1 pl-2">
                <h3 class="font-bold text-lg mb-5">Réseaux sociaux</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:underline">Facebook</a></li>
                    <li><a href="#" class="hover:underline">Twitter</a></li>
                    <li><a href="#" class="hover:underline">Instagram</a></li>
                    <li><a href="#" class="hover:underline">LinkedIn</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div class="flex-1 pl-2">
                <h3 class="font-bold text-lg mb-5">Newsletter</h3>
                <p class="text-sm mb-5">
                    Abonnez-vous à notre newsletter pour recevoir les dernières offres sur nos chambres et nos vacances à prix réduit.
                </p>
                <form action="#" method="POST" class="flex items-center">
                    <div class="flex items-center bg-white p-1 rounded-[5px] overflow-hidden">
                        <input type="email" placeholder="Entrez votre email" class="focus:outline-none bg-white p-3 pl-4 text-black w-full md:w-auto">
                        <button type="submit" class="bg-secondary rounded-[2.5px] text-white px-5 py-2 cursor-pointer">S'abonner</button>
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
