@extends('layout.index')

@section('title', 'Calmoms - Approval Psychologist')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/admin/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endpush

@section('content')
    {{-- Admin Page Approval Psychologist Structure --}}
    <div class="admin_approval-page-wrapper">
        <h4>Kelola Meditasi</h4>
        <div class="admin_approval-page-content-wrapper">
            <div class="admin_approval-page-left-wrapper">
                <a href="#" onclick="showModal()" class="admin_page-add-meditation">Tambahkan Meditasi &nbsp; <i class="fa-solid fa-plus"></i></a>
                <div class="admin_page-table-wrapper">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Thumbnail</th>
                                <th>Musik</th>
                                <th style="width: 100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meditations as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="admin_page-img-table-wrapper">
                                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail image">
                                        </div>
                                    </td>
                                    <td>
                                        <audio controls>
                                            <source src="{{ asset('storage/' . $item->music) }}" type="audio/mp3">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </td>
                                    <td class="admin_page-action-table">
                                        <i class="fa-solid fa-pen-to-square" onclick="showModalEdit({{ json_encode($item) }})"></i>
                                        <i class="fa-solid fa-trash" onclick="showModalDelete({{ $item->id }})"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <x-admin-card-menu />
        </div>
    </div>

    <!-- The Add Modal -->
    <div id="myModalAdd" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Tambah Meditasi</h2>
            <div id="modalBody">
                {{-- This is the form Add --}}
                <form action="{{ route('admin.addMeditation') }}" method="POST" enctype="multipart/form-data" class="admin_page-add_meditation-wrapper">
                    @csrf
                    <div class="admin_page-add_meditation-form-group-wrapper">
                        <label>Thumbnail:</label>
                        <input type="file" name="thumbnail" required>
                    </div>
                    <div class="admin_page-add_meditation-form-group-wrapper">
                        <label>Musik:</label>
                        <input type="file" name="music" required>
                    </div>
                    <div class="admin_page-add_meditation-form-group-wrapper">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Edit Modal -->
    <div id="myModalEdit" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalEdit()">&times;</span>
            <h2>Edit Meditasi</h2>
            <div id="modalBody">
                {{-- This is the form Edit --}}
                <form action="{{ route('admin.editMeditation') }}" method="POST" enctype="multipart/form-data" class="admin_page-add_meditation-wrapper">
                    @csrf
                    <input type="hidden" name="id" id="edit-id">
                    <div class="admin_page-add_meditation-form-group-wrapper">
                        <label>Current Thumbnail:</label>
                        <img id="edit-thumbnail-preview" src="" alt="Current Thumbnail" style="max-width: 100px;">
                    </div>
                    <div class="admin_page-add_meditation-form-group-wrapper">
                        <label>New Thumbnail (optional):</label>
                        <input type="file" name="thumbnail">
                    </div>
                    <div class="admin_page-add_meditation-form-group-wrapper">
                        <label>Current Music:</label>
                        <audio id="edit-music-preview" controls style="display: block;">
                            <source src="" type="audio/mp3">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                    <div class="admin_page-add_meditation-form-group-wrapper">
                        <label>New Music (optional):</label>
                        <input type="file" name="music">
                    </div>
                    <div class="admin_page-add_meditation-form-group-wrapper">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 3000,
                title: "{{ Session::get('success') }}",
            })
        </script>
    @endif

@endsection

@push('scripts')
    <script>
        var modalAdd = document.getElementById("myModalAdd");
        var modalEdit = document.getElementById("myModalEdit");

        function showModal() {
            modalAdd.style.display = "block";
        }

        function closeModal() {
            modalAdd.style.display = "none";
        }

        function showModalEdit(item) {
            modalEdit.style.display = "block";
            document.getElementById('edit-id').value = item.id;
            document.getElementById('edit-thumbnail-preview').src = `{{ asset('storage') }}/${item.thumbnail}`;
            document.getElementById('edit-music-preview').src = `{{ asset('storage') }}/${item.music}`;
        }

        function closeModalEdit() {
            modalEdit.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modalAdd) {
                modalAdd.style.display = "none";
            }
            if (event.target == modalEdit) {
                modalEdit.style.display = "none";
            }
        }

        function showModalDelete(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn-confirmation btn-wrapper-success",
                    cancelButton: "btn-confirmation btn-wrapper-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Apakah Anda Yakin?",
                text: "Kamu Tidak Dapat Mengembalikan Data Yang Sudah Dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak, Batalkan!",
                reverseButtons: true
            }).then((result) => {
                if(result.isConfirmed) {
                    fetch(`/delete-meditation/${id}`, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Reload the page
                            window.location.reload();
                            return response.json();
                        }
                        throw new Error('Network response was not ok.');
                    })
                    .then(data => {
                        // Show success toast
                        showToast('Berhasil Menghapus Meditasi', 'success');
                    })
                    .catch(error => {
                        // Show error toast
                        showToast('Gagal Menghapus Meditasi', 'error');
                        console.error('There was an error!', error);
                    });
                }
            });
        }

    </script>
@endpush
