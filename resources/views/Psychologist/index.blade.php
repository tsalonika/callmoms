@extends('layout.index')

@section('title', 'Calmoms - Dimana Anda Menemukan Solusi Anda dengan Psikolog Terpercaya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/psychologist/psychologist.css') }}">
@endpush

@section('content')
    <div class="psychologist_page-consultation-list-wrapper">
        <h4>Daftar Konsultasi</h4>
        @if (empty($result))
            <p class="empty_cards_message-wrapper">Anda Belum Memiliki Konsultasi dengan Ibu atau Keluarga</p>
        @else
            @foreach ($result as $item)
                <div class="psychologist_page-consultation-columns-wrapper"onclick="window.location.href='{{ url('/consultation-list/' . $item->id) }}'">
                    <div class="psychologist_page-card-list-wrapper">
                        <div class="psychologist_page-card-list-img-wrapper">
                            <img src="{{ asset('storage/' . $item->photo) }}" alt="Moms Photo">
                        </div>
                        <div class="psychologist_page-card-list-info-wrapper">
                            <p>{{ $item->name }}</p>
                            <span>{{ $item->last_message_content }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection