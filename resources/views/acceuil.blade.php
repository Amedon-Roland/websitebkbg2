@extends('layout')
@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background.jpg') }}');">

   {{-- Profile Card --}}

  


   <x-image-hero-section 
   backgroundImage="{{ asset('images/treehero.jpg') }}"
   title="Bienvenue à notre hôtel"
   description="Profitez d'un séjour inoubliable avec des vues spectaculaires et un service exceptionnel."
   :showScrollButton="true"
   scrollTarget="section-id"
/>


  {{-- Reservation Form --}}
  <div class="mt-8 flex items-center justify-center">
    <x-reservation-form />
</div>

</div>
@endsection
