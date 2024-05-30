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
    <title>Calmoms - Daftar</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
</head>
<body>
    <div class="auth_page-card-wrapper">
        <h4>Daftar</h4>
        <div class="auth_page-tab-wrapper">
            <button class="tablink active" onclick="openTab(event, 'family-tab')">Ibu / Keluarga</button>
            <button class="tablink" onclick="openTab(event, 'psychologist-tab')">Psikolog</button>
        </div>
        <div id="family-tab" class="tabcontent" style="display: block">
            <div class="auth_page-form-wrapper">
                <form action="{{ url('/register-user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="auth_page-input_text-wrapper">
                        <span>Nama Lengkap</span>
                        <input type="text" name="name" placeholder="Masukkan Nama Anda" required>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>No Telepon</span>
                        <input type="number" name="phoneNumber" placeholder="Masukkan No Telepon Anda">
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>Tempat Lahir</span>
                        <input type="text" name="birthOfPlace" placeholder="Masukkan Tempat Lahir Anda">
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>Tanggal Lahir</span>
                        <input type="date" name="birthOfDate" placeholder="Tanggal Lahir Anda">
                    </div>
                    <div class="auth_page-input_radio-wrapper">
                        <span>Peran</span>
                        <div>
                            <input type="radio" id="mom" name="role" value="mom" checked> <label for="mom">Ibu / Pasien</label>
                        </div>
                        <div>
                            <input type="radio" id="family" name="role" value="family"> <label for="family">Keluarga Pasien</label>
                        </div>
                    </div>
                    <div class="auth_page-input_radio-wrapper" id="jenis_kelamin" style="display: none">
                        <span>Jenis Kelamin</span>
                        <div>
                            <input type="radio" id="male" name="gender" value="male" checked> <label for="male">Pria</label>
                        </div>
                        <div>
                            <input type="radio" id="female" name="gender" value="female"> <label for="female">Wanita</label>
                        </div>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>Alamat Tempat Tinggal</span>
                        <input type="text" name="address" placeholder="Masukkan Alamat Anda" required>
                    </div>
                    <div class="auth_page-input_file-wrapper">
                        <span>Foto Profil</span>
                        <input type="file" name="photo" required>
                    </div>
                    <div class="auth_page-input_text-wrapper" id="jumlah_anak">
                        <span>Jumlah Anak</span>
                        <input type="number" name="children_num" placeholder="Masukkan Jumlah Anak Anda" required>
                    </div>
                    <div class="auth_page-input_text-wrapper" id="tahun_menikah">
                        <span>Tahun Menikah</span>
                        <input type="number" name="year_marriage" placeholder="Masukkan Tahun Menikah Anda" required>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>Password</span>
                        <input type="password" name="password" placeholder="Masukkan Sandi Anda" required>
                    </div>
                    <button type="submit">Daftar</button>
                </form>
            </div>
        </div>
        <div id="psychologist-tab" class="tabcontent">
            <div class="auth_page-form-wrapper">
                <form action="{{ url('/register-psychologist') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="auth_page-italic-title">*Informasi Pribadi</p>
                    <div class="auth_page-input_text-wrapper">
                        <span>Nama Lengkap</span>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Anda" required>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>No KTP</span>
                        <input type="text" name="id_card_number" value="{{ old('id_card_number') }}" placeholder="Masukkan No KTP Anda" required>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>Tempat Lahir</span>
                        <input type="text" name="birthOfPlace" value="{{ old('birthOfPlace') }}" placeholder="Masukkan Tempat Lahir Anda" required>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>Tanggal Lahir</span>
                        <input type="date" name="birthOfDate" placeholder="Tanggal Lahir Anda" required>
                    </div>
                    <div class="auth_page-input_radio-wrapper">
                        <span>Jenis Kelamin</span>
                        <div>
                            <input type="radio" id="male2" name="gender" value="male" checked> <label for="male2">Pria</label>
                        </div>
                        <div>
                            <input type="radio" id="female2" name="gender" value="female"> <label for="female2">Wanita</label>
                        </div>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>Alamat Tempat Tinggal</span>
                        <input type="text" name="address" placeholder="Masukkan Alamat Anda" required>
                    </div>
                    <div class="auth_page-input_file-wrapper">
                        <span>Foto Profil</span>
                        <input type="file" name="photo" required>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>No Telepon</span>
                        <input type="number" name="phoneNumber" placeholder="Masukkan No Telepon Anda" required>
                    </div>
                    <p class="auth_page-italic-title">*Informasi Pendidikan</p>
                    <div class="auth_page-input_text-wrapper">
                        <span>Institusi Pendidikan</span>
                        <input type="text" name="school" placeholder="Masukkan Institusi Pendidikan Anda" required>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>Tahun Kelulusan</span>
                        <input type="number" name="graduated_year" placeholder="Masukkan Tahun Kelulusan Anda" required>
                    </div>
                    <div class="auth_page-input_file-wrapper">
                        <span>Sertifikat Pendidikan</span>
                        <input type="file" name="certificate" required>
                    </div>
                    <p class="auth_page-italic-title">*Informasi Profesi</p>
                    <div class="auth_page-input_text-wrapper">
                        <span>Nomor Surat Tanda Registrasi Psikolog (STR)</span>
                        <input type="text" name="strp_number" placeholder="Masukkan Nomor Surat Tanda Registrasi Psikolog Anda" required>
                    </div>
                    <div class="auth_page-input_file-wrapper">
                        <span>Surat Tanda Registrasi Psikolog</span>
                        <input type="file" name="strp" required>
                    </div>
                    <div class="auth_page-input_text-wrapper">
                        <span>Password</span>
                        <input type="password" name="password" placeholder="Masukkan Sandi Anda" required>
                    </div>
                    <button type="submit">Daftar</button>
                </form>
            </div>
        </div>
        <div class="auth_page-bottom-text">
            <p>Sudah memiliki akun? <a href="{{ url('/login') }}">Masuk Disini</a></p>
        </div>
    </div>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Sukses",
                text: "{{ Session::get('success') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/login';
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
</body>
</html>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

     // Hide/Show the input
     var role = document.getElementsByName('role');
     var jenisKelamin = document.getElementById('jenis_kelamin');
     var jumlahAnak = document.getElementById('jumlah_anak');
     var tahunMenikah = document.getElementById('tahun_menikah');

     for (let i = 0; i < role.length; i++) {
        role[i].addEventListener('change', function() {
            if (this.value === 'mom') {
                jenisKelamin.style.display = 'none';
                jumlahAnak.style.display = 'flex';
                jumlahAnak.querySelector('input').setAttribute('required', 'true');
                tahunMenikah.style.display = 'flex';
                tahunMenikah.querySelector('input').setAttribute('required', 'true');
            } else if (this.value === 'family') {
                jenisKelamin.style.display = 'block';
                jumlahAnak.style.display = 'none';
                jumlahAnak.querySelector('input').removeAttribute('required');
                tahunMenikah.style.display = 'none';
                tahunMenikah.querySelector('input').removeAttribute('required');
            }
        });
    }

</script>