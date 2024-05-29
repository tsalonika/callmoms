@extends('layout.index')

@section('title', 'Calmoms - Kelola Artikel')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/psychologist/psychologist.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endpush

@section('content')
    {{-- Get Data from Session --}}
    @php
        $usersData = session('users_data');
        $psychologistID = isset($usersData['nested']['id']) ? $usersData['nested']['id'] : '-';
    @endphp

    {{-- Operate Articles View for psychologist --}}
    <div class="psychologist_article-container">
        <a href="#" onclick="showModalAddArticle()" class="psychologist_article-add-button">Tambahkan Artikel <i class="fa-solid fa-plus"></i></a>
        <div class="psychologist_article_operate-wrapper">
            @foreach ($articles as $item)
            <div class="psychologist_article-card">
                <div class="psychologist_article-img-wrapper">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="Article Illustration">
                </div>
                <h4>{{ $item->title }}</h4>
                <p>{{ truncateText($item->content, 100) }}</p>
                    @if ($psychologistID == $item->creator_id)
                        <div class="psychologist_menu-wrapper">
                            <i class="fa-solid fa-pen-to-square psychologist_menu-edit" onclick="showModalEditArticle({{ json_encode($item) }})"></i>
                            <i class="fa-solid fa-trash psychologist_menu-delete" onclick="showModalDelete({{ $item->id }})"></i>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- The Add Modal -->
    <div id="myModalAddArticle" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Tambah Artikel</h2>
            <div id="modalBody">
                {{-- This is the form Add --}}
                <form action="{{ route('psychologist.createArticle') }}" method="POST" enctype="multipart/form-data" class="psychologist_page-add_article-wrapper">
                    @csrf
                    <div class="psychologist_page-add_article-form-group-wrapper">
                        <label>Judul:</label>
                        <input type="text" name="title" placeholder="Masukkan Judul Artikel" value="{{ old('title') }}" required>
                    </div>
                    <div class="psychologist_page-add_article-form-group-wrapper">
                        <label>Gambar:</label>
                        <input type="file" name="image" required>
                    </div>
                    <div class="psychologist_page-add_article-form-group-wrapper">
                        <label>Konten:</label>
                        <textarea name="content" placeholder="Masukkan Isi dari Konten Artikel">{{ old('content') }}</textarea>
                    </div>
                    <input type="hidden" name="creator_id" value="{{ $psychologistID }}">
                    <div class="psychologist_page-add_article-form-group-wrapper">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Edit Modal -->
    <div id="myModalEditArticle" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalEdit()">&times;</span>
            <h2>Edit Artikel</h2>
            <div id="modalBody">
                {{-- This is the form Add --}}
                <form action="{{ route('psychologist.editArticle') }}" method="POST" enctype="multipart/form-data" class="psychologist_page-add_article-wrapper">
                    @csrf
                    <input type="hidden" name="id" id="edit-id">
                    <div class="psychologist_page-add_article-form-group-wrapper">
                        <label>Judul:</label>
                        <input type="text" name="title" id="title" placeholder="Masukkan Judul Artikel" value="{{ old('title') }}" required>
                    </div>
                    <div class="psychologist_page-add_article-form-group-wrapper">
                        <label>Tampilan Gambar:</label>
                        <img id="edit-image-preview" src="" alt="Current Image" style="max-width: 100px;">
                    </div>
                    <div class="psychologist_page-add_article-form-group-wrapper">
                        <label>Gambar:</label>
                        <input type="file" name="image">
                    </div>
                    <div class="psychologist_page-add_article-form-group-wrapper">
                        <label>Konten:</label>
                        <textarea name="content" id="edit-content" placeholder="Masukkan Isi dari Konten Artikel">{{ old('content') }}</textarea>
                    </div>
                    <input type="hidden" id="creator_id" name="creator_id" value="{{ $psychologistID }}">
                    <div class="psychologist_page-add_article-form-group-wrapper">
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
        var myModalAddArticle = document.getElementById("myModalAddArticle");
        var myModalEditArticle = document.getElementById("myModalEditArticle");

        function showModalAddArticle() {
            myModalAddArticle.style.display = "block";
        }

        function closeModal() {
            myModalAddArticle.style.display = "none";
        }

        function showModalEditArticle(item) {
            console.log('Showing edit modal with item:', item);
            myModalEditArticle.style.display = "block";
            document.getElementById('edit-id').value = item['id'];
            document.getElementById('title').value = item['title'];
            document.getElementById('edit-image-preview').src = `{{ asset('storage') }}/${item['image']}`;
            tinymce.get('edit-content').setContent(item['content']);
            document.getElementById('creator_id').value = item['creator_id'];
        }

        function closeModalEdit() {
            myModalEditArticle.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == myModalAddArticle) {
                myModalAddArticle.style.display = "none";
            }
            if (event.target == myModalEditArticle) {
                myModalEditArticle.style.display = "none";
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
                    fetch(`/delete-article/${id}`, {
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