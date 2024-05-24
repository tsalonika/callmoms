@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/components/components.css') }}">
@endpush

<div class="admin_approval-page-right-wrapper">
    <div class="admin_approval-card-menu" onclick="window.location.href='/approval-page'">
        <div class="admin_approval-card-img-wrapper">
            <img src="{{ asset('images/male-doctor-illustration.png') }}" alt="psychologist illustration">
        </div>
        <p>Kelola Aktivasi Psikolog</p>
    </div>
    <div class="admin_approval-card-menu" onclick="window.location.href='/operate-meditation'">
        <div class="admin_approval-card-img-wrapper">
            <img src="{{ asset('images/meditation.png') }}" alt="meditatation illustration">
        </div>
        <p>Kelola Meditasi</p>
    </div>
</div>