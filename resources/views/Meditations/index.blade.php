@extends('layout.index')

@section('title', 'Calmoms - Tenangkan Hati & Pikiran Anda dengan Mendengarkan Musik Meditasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/meditation/meditation.css') }}">
@endpush

@section('content')
    {{-- Meditation Page Structure --}}
    <div class="meditation_page-wrapper">
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="meditation_page-card">
            <div class="meditation_page-img-wrapper">
                <img src="{{ asset('images/meditation.png') }}" alt="Meditation Illustration">
            </div>
            <audio controls>
                <source src="/path/to/your/audio/file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
@endsection