@extends('layout')
@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background.jpg') }}');">

   {{-- Profile Card --}}


  {{-- Reservation Form --}}
  <div class="mt-8 flex items-center justify-center">
    <x-reservation-form />
</div>

</div>
@endsection
