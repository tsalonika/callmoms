@extends('layout.index')

@section('title', 'Calmoms - Tenangkan Hati & Pikiran Anda dengan Mendengarkan Musik Meditasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/meditation/meditation.css') }}">
@endpush

@section('content')
    {{-- Meditation Page Structure --}}
    <div class="meditation_page-wrapper">
        @if ($meditations->isEmpty())
            <x-no-data />
        @else
            @foreach ($meditations as $item)
                <div class="meditation_page-card">
                    <div class="meditation_page-img-wrapper">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Meditation Illustration">
                    </div>
                    <audio controls>
                        <source src="{{ asset('storage/' . $item->music) }}" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            @endforeach
        @endif
    </div>
@endsection