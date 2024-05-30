<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Display:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/auth/auth.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Calmoms - Masuk</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
</head>
<body>
    {{-- Get Data from Session --}}
    @php
        $usersData = session('users_data');
        $redirectUrl = '/';
        if (isset($usersData) && $usersData['role'] === 'admin') {
            $redirectUrl = '/approval-page';
        }
    @endphp
    
    {{-- Login Structure --}}
    <div class="auth_page-card-wrapper">
        <h4>Masuk</h4>
        <div class="auth_page-form-wrapper">
            <form action="" method="POST">
                @csrf
                <div class="auth_page-input_text-wrapper">
                    <span>No Telepon</span>
                    <input type="number" name="phoneNumber" placeholder="Masukkan No Telepon Anda" required>
                </div>
                <div class="auth_page-input_text-wrapper">
                    <span>Password</span>
                    <input type="password" name="password" placeholder="Masukkan Sandi Anda" required>
                </div>
                <button type="submit">Masuk</button>
            </form>
        </div>
        <div class="auth_page-bottom-text">
            <p>Belum memiliki akun? <a href="{{ url('/register') }}">Daftar Disini</a></p>
        </div>
        @if (Session::has('success'))
            <script>
                Swal.fire({
                    icon: "success",
                    title: "Sukses",
                    text: "{{ Session::get('success') }}",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ $redirectUrl }}';
                    }
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
    </div>
</body>
</html>