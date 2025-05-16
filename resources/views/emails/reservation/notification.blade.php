@component('mail::message')
# ✨ Nouvelle réservation #{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}

<div style="text-align: center; margin: 25px 0;">
    <span style="background-color: #4F46E5; color: white; padding: 8px 16px; border-radius: 9999px; font-weight: bold; font-size: 16px;">
        {{ $reservation->check_in_date->format('d M') }} → {{ $reservation->check_out_date->format('d M Y') }}
    </span>
</div>

@component('mail::panel')
## 👤 Informations du client

| | |
|---|---|
| **Nom** | {{ $reservation->title }} {{ $reservation->first_name }} {{ $reservation->last_name }} |
| **Email** | {{ $reservation->email }} |
| **Téléphone** | {{ $reservation->phone }} |
| **Adresse** | {{ $reservation->address ?? 'Non spécifiée' }} |
@endcomponent

@component('mail::panel')
## 🏨 Détails du séjour

| | |
|---|---|
| **Arrivée** | {{ $reservation->check_in_date->format('d/m/Y') }} |
| **Départ** | {{ $reservation->check_out_date->format('d/m/Y') }} |
| **Durée** | {{ $reservation->check_in_date->diffInDays($reservation->check_out_date) }} nuit(s) |
| **Personnes** | {{ $reservation->guests }} |
| **Chambre** | {{ $reservation->roomCategory->name }} |
| **N° chambre** | {{ $reservation->room ? $reservation->room->room_number : '⚠️ À attribuer' }} |
@endcomponent

@component('mail::panel')
## 📋 Options & services

@if ($reservation->breakfast || $reservation->pets || $reservation->late_checkout || $reservation->airport_transfer)
<ul style="list-style-type: none; padding-left: 0;">
@if ($reservation->breakfast)
<li>✓ Petit-déjeuner</li>
@endif
@if ($reservation->pets)
<li>✓ Animaux acceptés</li>
@endif
@if ($reservation->late_checkout)
<li>✓ Départ tardif</li>
@endif
@if ($reservation->airport_transfer)
<li>✓ Transfert aéroport</li>
@endif
</ul>
@else
<p>Aucune option sélectionnée</p>
@endif

@if($reservation->special_requests)
**Demandes spéciales:**
<div style="background-color: #f9fafb; padding: 10px; border-left: 4px solid #4F46E5; margin-top: 8px;">
{{ $reservation->special_requests }}
</div>
@else
**Demandes spéciales:** Aucune
@endif
@endcomponent

@component('mail::panel')
## 💰 Paiement
<div style="font-size: 18px; font-weight: bold; margin: 10px 0;">
Total: {{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA
</div>
**Méthode:** {{ ucfirst($reservation->payment_method) }}
@endcomponent

@component('mail::button', ['url' => config('app.url') . '/admin', 'color' => 'primary'])
Gérer cette réservation
@endcomponent

<div style="text-align: center; color: #6b7280; font-size: 14px; margin-top: 20px;">
<p>Réservation enregistrée le {{ $reservation->created_at->format('d/m/Y à H:i') }}</p>
<p>ID unique: {{ $reservation->uuid }}</p>
</div>

Merci,<br>
{{ config('app.name') }}
@endcomponent
