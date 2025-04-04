@extends('layout')
@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background.jpg') }}');">



    {{-- Reservation Form --}}
    <div class="mt-8 w-full max-w-5xl">
        <x-reservation-form />
    </div>

</div>
@endsection
