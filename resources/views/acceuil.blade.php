@extends('layout')
@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background.jpg') }}');">
    <x-room-card-desc
    image="{{ asset('images/room.jpg') }}"
    label="Premium"
    description="Très spacieuses, bien équipées avec 2 lits doubles, Vue sur la Mer"
    />

</div>
@endsection
