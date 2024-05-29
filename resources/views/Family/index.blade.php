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
            @php
                $getMessagesUrl = url('/messages-forum');
                $sendMessageUrl = url('/send-forum');
                $broadcastOn = 'my-channel-forum';
                $broadcastAs = 'my-event-forum';
            @endphp
            <x-chat-dialog :getMessagesUrl="$getMessagesUrl" :sendMessageUrl="$sendMessageUrl" :broadcastOn="$broadcastOn" :broadcastAs="$broadcastAs" />
        </div>
    </div>
@endsection