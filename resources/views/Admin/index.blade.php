@extends('layout.index')

@section('title', 'Calmoms - Approval Psychologist')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/admin/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endpush

@section('content')
    {{-- Admin Page Approval Psychologist Structure --}}
    <div class="admin_approval-page-wrapper">
        <h4>Approval Akun Psikolog</h4>
        <div class="admin_approval-page-content-wrapper">
            <div class="admin_approval-page-left-wrapper">
                <div class="admin_approval-page-info-wrapper">
                    <span><i class="fa-solid fa-mars" style="color: rgb(53, 151, 242);"></i> Laki-laki</span>
                    <span><i class="fa-solid fa-venus" style="color: palevioletred"></i> Perempuan</span>
                    <span><div class="pulse-dot-green"></div> Aktif</span>
                    <span><div class="pulse-dot-red"></div> Nonaktif</span>
                </div>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($psychologists as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['phoneNumber'] }}</td>
                                <td>{{ $item['address'] }}</td>
                                <td>
                                    @if ($item['gender'] === 'male')
                                        <i class="fa-solid fa-mars" style="color: rgb(53, 151, 242);"></i>
                                    @else
                                        <i class="fa-solid fa-venus" style="color: palevioletred"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($item['status'] === 'active')
                                        <div class="pulse-dot-green"></div>
                                    @else
                                        <div class="pulse-dot-red"></div>
                                    @endif
                                </td>
                                <td>
                                    <i class="fa-solid fa-eye" style="cursor: pointer" onclick="showModal({{ json_encode($item) }})"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <x-admin-card-menu />
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Psychologist Details</h2>
            <div id="modalBody">
                <!-- Modal content will be injected here -->
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        var modal = document.getElementById("myModal");

        function showModal(data) {
            modal.style.display = "block";

            var modalBody = document.getElementById("modalBody");
            modalBody.innerHTML = `
                <div class="modal_detail_psychologist">
                    <p><span>Nomor KTP</span> ${data.id_card_number}</p>
                    <p><span>Sekolah</span> ${data.school}</p>
                    <p><span>Tahun Kelulusan</span> ${data.graduated_year}</p>
                    <p><span>Nomor STRP</span> ${data.strp_number}</p>
                    <p><span>Ijazah</span> <a href="{{ asset('storage/${data.certificate}') }}" target="_blank">Lihat Ijazah</a></p>
                    <p><span>STRP Psikolog</span> <a href="{{ asset('storage/${data.strp}') }}" target="_blank">Lihat STRP Psikolog</a></p>
                    <div class="img_modal-wrapper">
                        <img src="{{ asset('storage/') }}/${data.photo}" alt="Photo">
                    </div> 
                    <div class="modal_activate-toggle">
                        Nonaktifkan / Aktikan
                        <label class="modal_switch-toggle">
                            <input id="status_${data.id}" type="checkbox" ${data.status === 'active' ? 'checked' : ''} onchange="toggleStatus(${data.id}, this.checked)">
                            <span class="modal_slider-toggle"></span>
                        </label>
                    </div>   
                </div>
            `;
        }

        function closeModal() {
            modal.style.display = "none";
        }

        function toggleStatus(id, status) {
            fetch('{{ route("admin.updateStatus") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id, status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endpush
