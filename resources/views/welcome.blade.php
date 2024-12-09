@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Example Post -->
        <x-post-card
            avatar="{{ asset('assets/logo.jpg') }}"
            username="JohnDoe"
            location="New York"
            image="{{ asset('assets/background.jpg') }}"
            caption="This is a sample post."
        />
    </div>
@endsection
