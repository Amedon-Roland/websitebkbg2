@extends('layout')


@section('content')

<x-image-hero-section
    backgroundImage="{{ asset('images/treehero.jpg') }}"
    title="Contact us"
    description="The elegant luxury bedrooms in this gallery showcase custom interior 
                designs & decorating ideas. View pictures and find your
                    perfect luxury bedroom design."
    :showScrollButton="false"
/>

@endsection