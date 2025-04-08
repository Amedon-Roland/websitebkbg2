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
        <div class="flex flex-wrap justify-center gap-8">
            {{-- Exemple de cartes de chambres --}}
            <x-room-card
                image="{{ asset('images/room.jpg') }}"
                title="Premium"
                availability="Available: Yes"
                price="80.000"
            />
            <x-room-card
                image="{{ asset('images/room.jpg') }}"
                title="Privilege"
                availability="Available: Yes"
                price="70.000"
            />
            <x-room-card
                image="{{ asset('images/room.jpg') }}"
                title="Senior"
                availability="Available: Yes"
                price="65.000"
            />
            <x-room-card
                image="{{ asset('images/room.jpg') }}"
                title="Standard"
                availability="Available: Yes"
                price="50.000"
            />
            <x-room-card
                image="{{ asset('images/room.jpg') }}"
                title="Junior"
                availability="Available: Yes"
                price="35.000"
            />
            <x-room-card
                image="{{ asset('images/room.jpg') }}"
                title="The Royal Room"
                availability="Available: Yes"
                price="190.000"
            />
        </div>
    </div>
</section>

@endsection
