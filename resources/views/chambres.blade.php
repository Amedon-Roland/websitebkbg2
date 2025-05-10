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
            @forelse($categories as $category)
                <x-room-card
                    image="{{ $category->image ? asset('storage/' . $category->image) : asset('images/room.jpg') }}"
                    title="{{ $category->name }}"
                    availability="{{ $category->getAvailableRoomsCount() . ' chambres disponibles' }}"
                    price="{{ is_numeric($category->price) ? number_format((float)$category->price, 0, ',', ' ') : $category->price }}"
                    :category="$category"
                />
            @empty
                <div class="text-center py-12">
                    <p class="text-lg text-gray-600">Aucune catégorie de chambre disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
