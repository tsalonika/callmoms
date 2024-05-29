@extends('layout.index')

@section('title', 'Calmoms - Dimana Anda Menemukan Solusi Anda dengan Psikolog Terpercaya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/profile/profile.css') }}">
@endpush

@section('content')
    {{-- Get Data from Session --}}
    @php
        $usersData = session('users_data');
    @endphp

    {{-- Profile Page Wrapper --}}
    <div class="profile_page-wrapper">
        <h4>Kelola Profil</h4>
        <div class="profile_page-cards-wrapper">
            <div class="profile_page-input-section-wrapper">
                <div class="profile_page-picture-wrapper">
                    <div class="profile_page-picture-circle-wrapper">
                        <img src="{{ asset('storage/' . $usersData['nested']['photo']) }}" alt="Profile Picture">
                    </div>
                    <p>{{ $usersData['nested']['name'] }}</p>
                </div>
                <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="role" value="{{ $usersData['role'] }}">
                    <input type="hidden" name="id" value="{{ $usersData['nested']['users_id'] }}">
                    <div class="profile_page-input-type-wrapper">
                        <input type="text" name="name" value="{{ $usersData['nested']['name'] }}" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="profile_page-input-type-wrapper">
                        <input type="text" name="birthOfPlace" value="{{ $usersData['birthOfPlace'] }}" placeholder="Masukkan Tempat Lahir" required>
                    </div>
                    <div class="profile_page-input-type-wrapper">
                        <input type="date" name="birthOfDate" value="{{ $usersData['birthOfDate'] }}" placeholder="Masukkan Tanggal Lahir" required>
                    </div>
                    <div class="profile_page-input-type-wrapper">
                        <input type="text" name="phoneNumber" value="{{ $usersData['phoneNumber'] }}" placeholder="Masukkan Nomor Telepon" required>
                    </div>
                    <div class="profile_page-input-type-wrapper">
                        <input type="text" name="address" value="{{ $usersData['nested']['address'] }}" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="profile_page-input-type-wrapper">
                        <input type="password" name="password" placeholder="Masukkan Password Baru (Opsional)">
                    </div>
                    <div class="profile_page-input-type-wrapper">
                        <input type="file" name="photo" id="file-upload" hidden>
                        <label for="file-upload" id="file-upload-label">Upload Foto Baru (Opsional)</label>
                    </div>
                    <div class="profile_page-input-type-wrapper" style="text-align: center">
                        <button type="submit">Perbarui Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Sukses",
                text: "{{ Session::get('success') }}",
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ Session::get('error') }}",
            });
        </script>
    @endif
    
@endsection

@push('scripts')
    
@endpush