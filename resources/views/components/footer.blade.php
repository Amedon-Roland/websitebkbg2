{{-- filepath: resources/views/components/footer.blade.php --}}
<footer class="bg-secondary text-white">
    {{-- Footer Container --}}
    <div  class="container pt-15 font-raleway mx-auto flex flex-col md:flex-row items-start justify-between py-8 px-4 md:px-8 gap-8 h-full">
        {{-- Footer Title --}}
        <div class="flex-shrink-0 md:w-1/4">
            <x-footer-title/>
        </div>

        {{-- Liens rapides --}}
        <div class="flex-1">
            <h3 class="font-bold text-lg mb-4">Liens rapides</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:underline">Réservation de salle</a></li>
                <li><a href="#" class="hover:underline">Chambres</a></li>
                <li><a href="#" class="hover:underline">Contact</a></li>
                <li><a href="#" class="hover:underline">Explorer</a></li>
            </ul>
        </div>

        {{-- Entreprise --}}
        <div class="flex-1">
            <h3 class="font-bold text-lg mb-4">Entreprise</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:underline">Politique de confidentialité</a></li>
                <li><a href="#" class="hover:underline">Politique de remboursement</a></li>
                <li><a href="#" class="hover:underline">F.A.Q</a></li>
                <li><a href="#" class="hover:underline">À propos</a></li>
            </ul>
        </div>

        {{-- Réseaux sociaux --}}
        <div class="flex-1">
            <h3 class="font-bold text-lg mb-4">Réseaux sociaux</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:underline">Facebook</a></li>
                <li><a href="#" class="hover:underline">Twitter</a></li>
                <li><a href="#" class="hover:underline">Instagram</a></li>
                <li><a href="#" class="hover:underline">LinkedIn</a></li>
            </ul>
        </div>

        {{-- Newsletter --}}
        <div class="flex-1">
            <h3 class="font-bold text-lg mb-4">Newsletter</h3>
            <p class="text-sm mb-4">
                Abonnez-vous à notre newsletter pour recevoir les dernières offres sur nos chambres et nos vacances à prix réduit.
            </p>
            <form action="#" method="POST" class="flex items-center ">
                <div class="flex items-center bg-white p-1 rounded-[5px] overflow-hidden">
                <input type="email" placeholder="Entrez votre email" class=" focus:outline-none bg-white p-2 text-black w-full md:w-auto">
                <button type="submit" class="bg-secondary rounded-[2.5px] text-white px-4 py-2 cursor-pointer">S'abonner</button>
            </div>
            </form>
        </div>


    </div>

    {{-- Copyright --}}
    <div class="border-t border-white text-center py-5">
        <p class="text-xs black">© 2025 Hotel BKBG </p>
    </div>
</footer>
