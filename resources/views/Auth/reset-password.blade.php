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
    <title>Calmoms - Reset Password</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
</head>
<body>
    {{-- Reset Password Structure --}}
    <div class="auth_page-card-wrapper">
        <h4>Reset Kata Sandi</h4>
        <div class="auth_page-form-wrapper">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="auth_page-input_text-wrapper">
                    <span>Email</span>
                    <input type="email" name="email" placeholder="Masukkan Email Anda" required>
                    @error('email')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit">Kirim Url Reset Kata Sandi</button>
            </form>
        </div>
    </div>
</body>

@if (Session::has('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "Sukses",
            text: "{{ Session::get('success') }}",
        });
    </script>
@endif

</html>