@extends('layout.index')

@section('title', 'Calmoms - DISINI NANTI JUDUL BERITA')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/article/article.css') }}">
@endpush

@section('content')
    {{-- Detail Article Structure --}}
    <div class="detail_article_page-wrapper">
        <h2>Lebih Rileks Pasca Melahirkan dengan Cara Ini</h2>
        <div class="detail_article_page-img-wrapper">
            <img src="{{ asset('images/article-illustration.jpg') }}" alt="Article Illustration">
        </div>
        <div class="detail_article_page-content-wrapper">
            {!! $article_detail !!}
        </div>
    </div>
@endsection