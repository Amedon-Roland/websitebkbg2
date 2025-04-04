@extends('layout')
@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background.jpg') }}');">

   {{-- Profile Card --}}

{{-- Exemple d'utilisation dans une vue --}}
<x-testimonies-card
    date="2 Mar. 2023"
    stars="3"
    text="lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
    image="images/im.jpg"
    author="Anthony Bruff"
/>


</div>
@endsection
