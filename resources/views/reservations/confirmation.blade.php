@extends('layout')

@section('content')
<div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
        <div class="max-w-2xl">
            <!-- Carte principale -->
            <div class="card w-full bg-base-100 shadow-xl">
                <div class="card-body">
                    <!-- En-tête de succès -->
                    <div class="alert alert-success shadow-lg mb-6">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-bold">Réservation confirmée!</h3>
                                <div class="text-xs">Un e-mail de confirmation vous a été envoyé.</div>
                            </div>
                        </div>
                    </div>

                    <h1 class="text-3xl font-bold text-center">Merci pour votre réservation</h1>
                    <p class="py-3">Votre séjour est maintenant réservé. Nous sommes impatients de vous accueillir.</p>

                    <!-- Référence -->
                    <div class="flex justify-center my-4">
                        <div class="badge badge-lg badge-primary gap-2 p-4">
                            <span class="text-base-100 font-bold">Référence:</span>
                            <span class="text-base-100 font-bold">#{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>

                    <!-- Détails principaux -->
                    <div class="card bg-base-200 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Détails du séjour
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-2">
                                <div class="flex flex-col">
                                    <span class="text-sm opacity-70">Date d'arrivée</span>
                                    <span class="font-medium">{{ $reservation->check_in_date->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm opacity-70">Date de départ</span>
                                    <span class="font-medium">{{ $reservation->check_out_date->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm opacity-70">Durée</span>
                                    <span class="font-medium">{{ $reservation->check_in_date->diffInDays($reservation->check_out_date) }} nuit(s)</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm opacity-70">Voyageurs</span>
                                    <span class="font-medium">{{ $reservation->guests }} personne(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Information sur la chambre -->
                    <div class="collapse collapse-arrow mt-4 border rounded-box">
                        <input type="checkbox" class="peer" checked /> 
                        <div class="collapse-title bg-primary text-white font-medium flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Détails de la chambre
                        </div>
                        <div class="collapse-content bg-base-100"> 
                            <div class="pt-4 pb-2">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium">{{ $reservation->roomCategory->name }}</span>
                                    <span class="badge badge-secondary">{{ number_format($reservation->roomCategory->price, 0, ',', ' ') }} FCFA/nuit</span>
                                </div>
                                <p class="text-sm mb-2">{{ $reservation->roomCategory->description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Information de contact -->
                    <div class="collapse collapse-arrow mt-4 border rounded-box">
                        <input type="checkbox" class="peer" /> 
                        <div class="collapse-title bg-base-200 font-medium flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informations personnelles
                        </div>
                        <div class="collapse-content bg-base-100"> 
                            <div class="pt-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div class="flex flex-col">
                                        <span class="text-sm opacity-70">Nom complet</span>
                                        <span class="font-medium">{{ $reservation->title }} {{ $reservation->first_name }} {{ $reservation->last_name }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm opacity-70">Email</span>
                                        <span class="font-medium">{{ $reservation->email }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm opacity-70">Téléphone</span>
                                        <span class="font-medium">{{ $reservation->phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Récapitulatif de prix -->
                    <div class="card bg-base-100 mt-6 border">
                        <div class="card-body p-4">
                            <h3 class="card-title text-lg">Récapitulatif du prix</h3>
                            
                            <div class="space-y-2 text-sm mt-2">
                                <div class="flex justify-between">
                                    <span>Prix de la chambre ({{ $reservation->check_in_date->diffInDays($reservation->check_out_date) }} nuit(s))</span>
                                    <span>{{ number_format($reservation->roomCategory->price * $reservation->check_in_date->diffInDays($reservation->check_out_date), 0, ',', ' ') }} FCFA</span>
                                </div>
                                
                                @if($reservation->breakfast)
                                <div class="flex justify-between">
                                    <span>Petit-déjeuner</span>
                                    <span>5 000 FCFA</span>
                                </div>
                                @endif
                                
                                @if($reservation->pets)
                                <div class="flex justify-between">
                                    <span>Animaux</span>
                                    <span>5 000 FCFA</span>
                                </div>
                                @endif
                                
                                <div class="flex justify-between">
                                    <span>Taxe de séjour</span>
                                    <span>1 000 FCFA</span>
                                </div>
                                
                                <div class="divider my-0"></div>
                                
                                <div class="flex justify-between font-medium">
                                    <span>Prix total</span>
                                    <span class="badge badge-lg badge-primary text-base-100">{{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message d'aide -->
                    <div class="alert alert-info mt-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Si vous avez des questions concernant votre réservation, n'hésitez pas à contacter notre équipe de service client.</span>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="card-actions justify-center mt-6">
                        <a href="{{ route('acceuil') }}" class="btn btn-primary btn-wide">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Animation de confettis -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuration des confettis
        var duration = 3 * 1000; // 3 secondes
        var end = Date.now() + duration;

        // Lancer les confettis
        (function frame() {
            // Lancer des confettis depuis différentes positions
            confetti({
                particleCount: 2,
                angle: 60,
                spread: 55,
                origin: { x: 0, y: 0.6 }
            });

            confetti({
                particleCount: 2,
                angle: 120,
                spread: 55,
                origin: { x: 1, y: 0.6 }
            });

            // Arrêter lorsque le temps est écoulé
            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        }());

        // Un éclatement initial pour célébrer
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 }
        });
    });
</script>
@endpush
@endsection