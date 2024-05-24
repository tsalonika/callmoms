@extends('layout.index')

@section('title', 'Calmoms - Dimana Anda Menemukan Solusi Anda dengan Dokter Terpercaya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/mom/mom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endpush

@section('content')
    {{-- Consultation Page from Mom View --}}
    <div class="mom_page-consultations-wrapper">
        <h4>Konsultasi</h4>
        <div class="mom_page-consultations-dialog-wrapper">
            <div class="mom_page-consultations-dialog-left-side">
                @foreach ($result as $item)
                    <div class="mom_page-consultations-card-user_menu" onclick="window.location.href='{{ url('/consultations/' . $item->id) }}'">
                        <div class="mom_page-consultations-card-img_wrapper">
                            <img src="{{ asset('storage/' . $item->photo) }}" alt="Psychologists Image">
                        </div>
                        <div class="mom_page-consultations-message_side-wrapper">
                            <p>{{ $item->name }}</p>
                            <span>{{ $item->last_message_content }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mom_page-consultations-dialog-right-side">
                @php
                    $getMessagesUrl = url('/messages');
                    $sendMessageUrl = url('/send');
                @endphp
                <x-chat-dialog :getMessagesUrl="$getMessagesUrl" :sendMessageUrl="$sendMessageUrl" />
            </div>
        </div>
    </div>
@endsection