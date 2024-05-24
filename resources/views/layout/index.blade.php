<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Display:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/layout/layout.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
    <title>@yield('title')</title>
</head>
<body>
    {{-- Get Data from Session --}}
    @php
        $usersData = session('users_data');
        $profileImage = isset($usersData['nested']['photo']) ? asset('storage/' . $usersData['nested']['photo']) : asset('images/admin-illustration.png');
    @endphp

    <div class="mega-container">
        <nav class="navbar-container" style="background-color: {{ $navbarBgColor ?? 'none' }}">
            <div class="left_side_nav-wrapper">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Image">
                <span>Calmom's</span>
            </div>
            <div class="right_side_nav-wrapper">
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ url('/articles') }}">Artikel</a>
                <div class="dropdown">
                    <a href="#">Layanan Khusus</a>
                    <div class="dropdown-content">
                        @if (isset($usersData) && $usersData['role'] === 'family')
                            <a href="#">Forum Diskusi</a>
                        @endif
                        @if (isset($usersData) && $usersData['role'] === 'mom')
                            <a href="{{ route('mom.showConsultation') }}">Konsultasi</a>
                        @elseif (isset($usersData) && $usersData['role'] === 'psychologist')
                            <a href="{{ route('pyschologist.messageWithMom') }}">Konsultasi</a>
                        @endif
                    </div>
                </div>
                @if (isset($usersData) && $usersData['role'] === 'mom')
                    <a href="#">Catatan Emosi</a>
                @endif
                <a href="{{ url('/meditations') }}">Meditasi</a>
                <a href="#">Profil</a>
                @if (isset($usersData))
                    <div class="link_nav-profile-section">
                        <div class="link_nav_profile-wrapper" onclick="showLogout()">
                            <img src="{{ $profileImage }}" alt="Profile Image">
                        </div>
                        <a href="{{ route('logout') }}" class="link_nav-logout">Keluar</a>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="link_nav_sign-in">Masuk</a>
                @endif
            </div>
        </nav>
        <div class="content-container">
            @yield('content')
        </div>
    </div>
    <div class="footer-container">
        <div class="footer-wrapper">
            <p>© Copyright Calmoms | Institut Teknologi Del</p>
        </div>
    </div>
</body>
</html>

<script>
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('.navbar-container');
        if (window.scrollY > 0) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    function showLogout () {
        var iconProfile = document.querySelector('.link_nav-logout')

        if(iconProfile.style.display === 'block') {
            iconProfile.style.display = 'none'
        } else {
            iconProfile.style.display = 'block'
        }
    }
</script>
@stack('scripts')