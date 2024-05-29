@extends('layout.index')

@section('title', 'Calmoms - DISINI NANTI JUDUL BERITA')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/article/article.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endpush

@section('content')
    {{-- Detail Article Structure --}}
    <div class="detail_article_page-wrapper">
        <h2>{{ $article_detail->title }}</h2>
        <div class="detail_article_page-img-wrapper">
            <img src="{{ asset('storage/' . $article_detail->image) }}" alt="Article Illustration">
        </div>
        <div class="detail_article_page-content-wrapper">
            <div class="detail_article_page-creator-wrapper">
                Kreator <i class="fa-solid fa-pen-nib"></i> : {{ $creator->name }}
            </div>
            {!! $article_detail->content !!}
        </div>
    </div>
@endsection