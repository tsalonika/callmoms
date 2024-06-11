@extends('layout.index')

@section('title', 'Calmoms - Tenangkan Hati & Pikiran Anda dengan Mendengarkan Musik Meditasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/meditation/meditation.css') }}">
@endpush

@section('content')
    {{-- Meditation Page Structure --}}
    <div class="meditation_page-container">
        <div class="meditation_page-tips_trick-wrapper">
            <div class="meditation_page-tips_trick_banner-wrapper">
                <p>Tips & Trick</p>
            </div>
            <div class="meditation_page-column-tips-wrapper">
                <div class="meditation_page-column-items-wrapper">
                    <h4>1. Temukan Posisi yang Nyaman</h4>
                    <p>Cari tempat yang tenang dan nyaman. Duduklah dengan posisi yang moms rileks, bisa dengan bersandar pada bantal atau dinding. Jika moms merasa lebih nyaman berbaring, itu juga tidak masalah. Pastikan posisi tubuh mendukung kenyamanan dan relaksasi.</p>
                </div>
                <div class="meditation_page-column-items-wrapper">
                    <h4>2. Tarik Napas Dalam-Dalam</h4>
                    <p>Mulailah dengan menarik napas dalam-dalam melalui hidung hingga perut mengembang. Rasakan bagaimana udara mengisi perut. Hembuskan napas perlahan-lahan melalui mulut. Ulangi langkah ini selama dua menit. Napas yang dalam dan teratur ini akan membantu menenangkan pikiran dan tubuh mom;s, serta memberi oksigen yang dibutuhkan oleh tubuh.</p>
                </div>
                <div class="meditation_page-column-items-wrapper">
                    <h4>3. Temukan Posisi yang Nyaman</h4>
                    <p>Saat meditasi, biarkan pikiran mom's mengalir tanpa menilai atau mengkritik. Jika pikiranmu mulai mengembara, jangan merasa bersalah. Ini adalah hal yang normal. Kembalikan fokus mom's pada napas yang masuk dan keluar dari tubuh dengan lembut. Ingatlah bahwa meditasi adalah waktu untuk memberikan diri sendiri kasih sayang dan penerimaan.</p>
                </div>
                <div class="meditation_page-column-items-wrapper">
                    <h4>4. Temukan Posisi yang Nyaman</h4>
                    <p>Setelah selesai bermeditasi, jangan terburu-buru untuk bangun. Luangkan beberapa saat untuk memperhatikan suara di sekitar mom's. Biarkan dirimu perlahan kembali ke keadaan sadar penuh. Rasakan kenyamanan dan ketenangan yang telah mom’s peroleh dari meditasi.</p>
                </div>
            </div>
        </div>
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
                        <p class="source-youtube">Src: {{ $item->source }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection