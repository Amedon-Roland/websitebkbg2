@extends('layout')
@section('title', 'Contact - Hôtel BKBG')
@section('content')

<x-image-hero-section
    backgroundImage="{{ asset('images/treehero.jpg') }}"
    title="Contact us"
    description="The elegant luxury bedrooms in this gallery showcase custom interior 
                designs & decorating ideas. View pictures and find your
                    perfect luxury bedroom design."
    :showScrollButton="false"
/>

<x-contact-form />

<!-- Ajout de la carte Leaflet avec l'emplacement de l'hôtel -->
<x-leaflet-map 
    latitude="6.16668"
    longitude="1.33667"
    zoom="15"
    hotelName="Hôtel BKBG"
    address="Quartier Baguida-Bateauvi, Bd du Mono, Lomé, Togo"
    phone="+228 91415656"
    email="contact@hotelbkbg.com"
/>

@endsection