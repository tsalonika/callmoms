@extends('layout.index')

@section('title', 'Calmoms - Dimana Anda Menemukan Solusi Anda dengan Psikolog Terpercaya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/home/home.css') }}">
@endpush

@section('content')
    {{-- Get Data from Session --}}
    @php
        $usersData = session('users_data');
    @endphp

    {{-- Jumbotron Structure --}}
    <div class="jumbotron-wrapper">
        <div class="left_jumbotron-side">
            <p><b>The Best</b> mom Mental Health <b>Solution For You</b></p>
        </div>
        <div class="right_jumbotron-side">
            <img src="{{ asset('images/doctor-illustration.png') }}" alt="Doctor Illustration Jumbotron">
        </div>
    </div>

    {{-- Artikel Structure --}}
    <div class="articles_home-wrapper">
        <h4>Artikel</h4>
        <div class="articles_cards_home-wrapper">
            @if ($articles->isEmpty())
                <x-no-data />
            @else
                @foreach ($articles as $index => $article)
                    @if ($index == 0)
                    <div class="article_big_card" onclick="window.location.href='{{ url('/articles/' . $article->id_articles) }}'">
                        <div class="article_home-img-big-wrapper">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Article Illustration">
                        </div>
                        <p>{{ $article->title }}</p>
                    </div>
                    <div class="articles_right_side-wrapper">
                    @else
                    <div class="article_small_card" onclick="window.location.href='{{ url('/articles/' . $article->id_articles) }}'">
                        <div class="article_home-img-small-wrapper">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Article Illustration">
                        </div>
                        <p>{{ $article->title }}</p>
                    </div>
                    @if ($index == count($articles) - 1)
                        </div>
                    @endif
                    @endif
                @endforeach
            @endif
            </div>
        </div>
    </div>

    {{-- Rekomendasi Dokter Structure --}}
    @if (isset($usersData) && $usersData['role'] === 'mom')
        <div class="recommendation_home-wrapper">
            <h4>Rekomendasi Psikolog</h4>
            <div class="recommendation_home_cards-wrapper">
                @foreach ($psychologists as $item)
                <div class="recommendation_home-cards">
                    <div class="recommendation_home-img-wrapper">
                        <img src="{{ asset('storage/' . $item->photo) }}" alt="Doctor Illustration">
                    </div>
                    <div class="recommendation_home-right-side">
                        <p>{{ $item->name }}</p>
                        <a href="{{ url('/consultations/' . $item->users_id) }}">Konsultasi</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="view_more-wrapper">
                <a href="{{ url('/consultations') }}">Lihat Selengkapnya</a>
            </div>
        </div>
    @endif

    {{-- Meditasi Structure --}}
    <div class="meditation_home-wrapper">
        <h4>Dengarkan Musik Meditasi</h4>
        <div class="meditation_home-cards-wrapper">
            @if ($meditations->isEmpty())
                <x-no-data />
            @else
                @foreach ($meditations as $item)
                    <div class="meditation_home-cards">
                        <div class="recommendation_home-img-wrapper">
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
        <div class="view_more-wrapper">
            <a href="{{ url('/meditations') }}">Lihat Selengkapnya</a>
        </div>
    </div>

    {{-- Tentang & Layanan Calmoms --}}
    <div class="about_service_home-wrapper">
        <div class="about_service_home-content">
            <h4>Tentang Calmom's</h4>
            <p>Callmom's hadir untuk membantu Anda menghadapi tantangan kesehatan mental dan memberikan dukungan terdepan bagi para ibu yang mengarungi perjalanan luar biasa  dalam kehamilan! Kami hadir dengan satu tujuan yang teguh: membantu Anda  menjaga kesehatan mental yang kuat dan mencegah gangguan kesehatan  mental selama masa kehamilan yang kritis ini. Dapatkan wawasan mendalam  tentang kesejahteraan emosional Anda dengan tes kondisi perasaan kami  yang interaktif, sambil menikmati akses langsung ke layanan khusus  seperti konsultasi online dengan profesional kesehatan mental yang  berpengalaman dan sesi meditasi yang menenangkan. Di Calmom's, kami  mengutamakan keamanan dan kenyamanan Anda dengan fitur autentikasi kami  yang aman, sehingga Anda dapat dengan mudah mengakses semua layanan dan  fitur Calmom's dengan tenang, tanpa khawatir tentang privasi dan  keamanan data Anda. Bersama-sama, kita dapat menjalani perjalanan  kehamilan dengan lebih tenang dan percaya diri. Selamat datang di  Calmom's - tempat di mana Anda tidak pernah sendiri dalam perjalanan  kehidupan yang penuh cinta ini.</p>
        </div>
        <div class="about_service_home-content">
            <h4>Layanan</h4>
            <p>Calmom's adalah sebuah platform inovatif yang didedikasikan untuk mendukung kesehatan mental ibu selama masa kehamilan dengan berbagai fitur yang menarik. Dari artikel informatif hingga sesi meditasi yang menenangkan, serta konsultasi langsung dengan profesional kesehatan mental, Calmom's hadir untuk membantu ibu dalam menghadapi tantangan emosional yang mungkin terjadi selama perjalanan kehamilan mereka. Melalui tes kondisi perasaan interaktif, ibu dapat memantau kesejahteraan emosional mereka dengan mudah. Tidak hanya itu, fitur-fitur tersebut juga dapat dinikmati oleh keluarga untuk mendukung ibu selama perjalanan kehamilan mereka. Dengan fokus pada keamanan dan privasi data, Calmom's memberikan rasa nyaman bagi pengguna untuk mengakses semua layanan tanpa kekhawatiran. Jadi, selamat datang di Calmom's - tempat di mana dukungan dan ketenangan selalu tersedia bagi ibu yang menjalani perjalanan kehamilan mereka.</p>
        </div>
    </div>

@endsection