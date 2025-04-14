@extends('layout')
@section('content')
  {{-- Première colonne --}}
<x-explore-hero 
    videoUrl="videos/test.mp4"
    :autoplay="false"  {{-- Set to true if you want video to start automatically --}}
    :muted="false"    {{-- Set to false if you want audio enabled --}}
    :loop="false"      {{-- Set to true if you want video to loop --}}
/>

{{-- Deuxième section --}}

<div class="mt-16 px-6 md:px-12 lg:px-24 mb-5">
    <h2 class="text-3xl md:text-4xl font-medium font-poppins text-center text-black mb-4">Take a tour</h2>

</div>

<x-landscape-card
image="{{ asset('images/room.jpg') }}"
title="Chambres luxueuses"
description="Les chambres de luxe élégantes de cette galerie présentent des designs d'intérieur et des idées de décoration personnalisées. Regardez des photos et trouvez le design de chambre de luxe idéal. Des chambres luxueuses qui vous donneront envie de ne plus jamais quitter votre chambre."
/>

<x-landscape-card
image="{{ asset('images/room.jpg') }}"
title="Salle de gymme"
description="Les chambres de luxe élégantes de cette galerie présentent des designs d'intérieur et des idées de décoration personnalisées. Regardez des photos et trouvez le design de chambre de luxe idéal. Des chambres luxueuses qui vous donneront envie de ne plus jamais quitter votre chambre."
/>

<x-landscape-card
image="{{ asset('images/room.jpg') }}"
title="Restaurant"
description="Les chambres de luxe élégantes de cette galerie présentent des designs d'intérieur et des idées de décoration personnalisées. Regardez des photos et trouvez le design de chambre de luxe idéal. Des chambres luxueuses qui vous donneront envie de ne plus jamais quitter votre chambre."
/>

@endsection

