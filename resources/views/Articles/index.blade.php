@extends('layout.index')

@section('title', 'Calmoms - Temukan Berbagai Insight Artikel Langsung dari Dokter')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/article/article.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endpush

@section('content')
    {{-- Get Data from Session --}}
    @php
        $usersData = session('users_data');
    @endphp

    {{-- Articles Page Structure --}}
    <div class="article_page-container-wrapper">
        @if ($usersData && $usersData['role'] === 'psychologist')
            <a href="{{ route('psychologist.showListArticles') }}" class="articles_page-btn-operate">Kelola Artikel <i class="fa-solid fa-gears"></i></a>
        @endif
        <div class="articles_page-wrapper">
            @if ($articles->isEmpty())
                <x-no-data />
            @else
                @foreach ($articles as $item)
                    <div class="articles_page-card" onclick="window.location.href='{{ url('/articles/' . $item->id) }}'">
                        <div class="articles_page-img-wrapper">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Article Illustration">
                        </div>
                        <h4>{{ $item->title }}</h4>
                        <p>{{ truncateText($item->content, 100) }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
