@extends('layout')
@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background.jpg') }}');">
    <x-installation-card
    icon="{{ asset('icons/swim.svg') }}"
    title="Installation 1"
    />

</div>
@endsection
