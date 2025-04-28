@extends('layout')

@section('content')

<x-image-hero-section
backgroundImage="{{ asset('images/treehero.jpg') }}"
title="Bienvenue à notre hôtel"
description="Profitez d'un séjour inoubliable avec des vues spectaculaires et un service exceptionnel."
:showScrollButton="true"
scrollTarget="section-id"
/>

{{-- Section des chambres --}}
<section id="section-id" class="py-16 bg-gray-100">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center text-primary mb-8">Nos Chambres</h2>
        <div class="flex flex-wrap justify-center gap-8">
            @forelse($rooms as $room)
                <x-room-card
                    image="{{ $room->image ? asset('storage/' . $room->image) : asset('images/room.jpg') }}"
                    title="{{ $room->title }}"
                    availability="{{ $room->availability_text }}"
                    price="{{ number_format($room->price, 3, '.', '') }}"
                />
            @empty
                <div class="text-center py-12">
                    <p class="text-lg text-gray-600">Aucune chambre disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
