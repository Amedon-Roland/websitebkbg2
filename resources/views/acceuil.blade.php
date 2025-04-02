@extends('layout')
@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background.jpg') }}');">

   {{-- Profile Card --}}
   <x-profile-card
   image="{{ asset('images/im.jpg') }}"
   name="Chidinma James"
   role="Manager"
/>


</div>
@endsection
