@extends('layout.index')

@section('title', 'Calmoms - Dimana Anda Menemukan Solusi Anda dengan Dokter Terpercaya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/mom/mom.css') }}">
@endpush

@section('content')
    {{-- Consultation Page from Mom View --}}
    <div class="mom_page-consultations-wrapper">
        <h4>Konsultasi</h4>
        <p class="mom_page-consultations-desc">Mendapatkan solusi lengkap untuk kesehatan Anda hanya sejauh genggaman. Menemukan jawaban untuk masalah kesehatan mental ibu, dan mendapatkan dukungan yang Anda butuhkan.</p>
        <h5>Konsultasi Dengan Psikolog Pilihan</h5>
        <div class="mom_page-consultation-cards-wrapper">
            @foreach ($psychologists as $item)
                <div class="mom_page-consultation-cards">
                    <div class="mom_page-consultation-cards-img-wrapper">
                        <img src="{{ asset('storage/' . $item->photo) }}" alt="Doctor Illustration">
                    </div>
                    <div class="mom_page-consultation-cards-right-side">
                        <p>{{ $item->name }}</p>
                        <a href="{{ url('/consultations/' . $item->users_id) }}">Konsultasi</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection