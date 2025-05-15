@component('mail::message')
# Confirmation de réservation

Cher(e) **{{ $reservation->title }} {{ $reservation->first_name }} {{ $reservation->last_name }}**,

Nous vous remercions d'avoir choisi l'Hôtel BKBG pour votre séjour. Votre réservation a bien été enregistrée.

## Détails de votre réservation

**Référence de réservation:** #{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}  
**Date d'arrivée:** {{ $reservation->check_in_date->format('d/m/Y') }}  
**Date de départ:** {{ $reservation->check_out_date->format('d/m/Y') }}  
**Durée du séjour:** {{ $reservation->check_in_date->diffInDays($reservation->check_out_date) }} nuit(s)  
**Nombre de personnes:** {{ $reservation->guests }}  
**Type de chambre:** {{ $reservation->roomCategory->name }}  
**Prix total:** {{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA

## Options sélectionnées

@if ($reservation->breakfast)
- Petit-déjeuner
@endif
@if ($reservation->pets)
- Animaux acceptés
@endif
@if ($reservation->late_checkout)
- Départ tardif (sous réserve de disponibilité)
@endif
@if ($reservation->airport_transfer)
- Transfert aéroport
@endif

@component('mail::button', ['url' => $pdfUrl])
Télécharger la confirmation en PDF
@endcomponent

Si vous avez des questions concernant votre réservation, n'hésitez pas à nous contacter.

Nous nous réjouissons de vous accueillir bientôt à l'Hôtel BKBG !

Cordialement,  
L'équipe de l'Hôtel BKBG
@endcomponent
