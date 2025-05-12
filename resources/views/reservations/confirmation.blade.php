@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-lg mx-auto text-center">
        <div class="mb-8">
            <div class="mx-auto bg-green-100 rounded-full w-16 h-16 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-3">Réservation réussie!</h1>
        <p class="text-lg text-gray-600 mb-8">
            Votre réservation a été confirmée avec succès. Un e-mail de confirmation vous a été envoyé.
        </p>
        
        <div class="bg-white p-6 rounded-xl shadow-md mb-8">
            <h2 class="text-xl font-semibold mb-4">Récapitulatif de votre réservation</h2>
            
            <div class="grid grid-cols-2 gap-4 text-left mb-4">
                <div>
                    <p class="text-sm text-gray-500">Référence</p>
                    <p class="font-medium">#{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Nom</p>
                    <p class="font-medium">{{ $reservation->title }} {{ $reservation->first_name }} {{ $reservation->last_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium">{{ $reservation->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Téléphone</p>
                    <p class="font-medium">{{ $reservation->phone }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Type de chambre</p>
                    <p class="font-medium">{{ $reservation->roomCategory->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Prix par nuit</p>
                    <p class="font-medium">{{ number_format($reservation->roomCategory->price, 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="col-span-2 mt-2">
                    <p class="text-sm text-gray-500">Détails de la chambre</p>
                    <p class="text-sm">{{ $reservation->roomCategory->description }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Personnes</p>
                    <p class="font-medium">{{ $reservation->guests }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Arrivée</p>
                    <p class="font-medium">{{ $reservation->check_in_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Départ</p>
                    <p class="font-medium">{{ $reservation->check_out_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Durée du séjour</p>
                    <p class="font-medium">{{ $reservation->check_in_date->diffInDays($reservation->check_out_date) }} nuit(s)</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Prix de base</p>
                    <p class="font-medium">{{ number_format($reservation->roomCategory->price * $reservation->check_in_date->diffInDays($reservation->check_out_date), 0, ',', ' ') }} FCFA</p>
                </div>
                
                @if($reservation->breakfast || $reservation->pets)
                    <div class="col-span-2">
                        <p class="text-sm text-gray-500">Services supplémentaires</p>
                        <div class="pl-2">
                            @if($reservation->breakfast)
                                <p class="text-sm">Petit-déjeuner: 5 000 FCFA</p>
                            @endif
                            @if($reservation->pets)
                                <p class="text-sm">Animaux: 5 000 FCFA</p>
                            @endif
                        </div>
                    </div>
                @endif
                
                <div class="col-span-2">
                    <p class="text-sm text-gray-500">Taxe de séjour</p>
                    <p class="text-sm">1 000 FCFA</p>
                </div>
                
                <div class="col-span-2 mt-2 border-t border-gray-200 pt-2">
                    <div class="flex justify-between">
                        <p class="text-gray-800 font-medium">Prix total</p>
                        <p class="text-gray-800 font-bold">{{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA</p>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <p class="text-gray-700 text-sm">
                Si vous avez des questions concernant votre réservation, n'hésitez pas à contacter notre équipe de service client.
            </p>
        </div>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('acceuil') }}" class="bg-primary hover:bg-primary/90 text-white py-2 px-6 rounded-md transition">
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection