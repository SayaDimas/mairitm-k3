@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Materi</h1>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Menampilkan Error Validasi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk Menambahkan Materi -->
    <form id="materiForm" action="{{ route('guru.modules.store_materi', $module->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Opsi Menambahkan Konten -->
        <div class="mb-3">
            <button type="button" class="btn btn-secondary" id="addTextContent">Tambah Teks</button>
            <button type="button" class="btn btn-secondary" id="addImageContent">Tambah Gambar</button>
            <button type="button" class="btn btn-secondary" id="addVideoContent">Tambah Video</button>
        </div>

        <!-- List Materi yang Akan Ditambahkan -->
        <div id="materiList"></div>

        <button type="submit" class="btn btn-success mt-3">Simpan Materi</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let materiCount = 0;

        // Fungsi untuk Menambahkan Konten Baru
        function addContent(type) {
            materiCount++;
            let contentHTML = '';

            if (type === 'text') {
                contentHTML = `
                    <div class="materi-item border rounded p-3 mb-3" data-id="${materiCount}">
                        <h5>Materi ${materiCount} - Teks</h5>
                        <input type="hidden" name="materi[${materiCount}][type]" value="text">
                        <div class="mb-3">
                            <label for="title_${materiCount}" class="form-label">Judul Materi</label>
                            <input type="text" name="materi[${materiCount}][title]" id="title_${materiCount}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="content_${materiCount}" class="form-label">Isi Materi</label>
                            <textarea name="materi[${materiCount}][content]" id="content_${materiCount}" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="button" class="btn btn-danger remove-materi" data-id="${materiCount}">Hapus</button>
                    </div>`;
            } else if (type === 'image') {
                contentHTML = `
                    <div class="materi-item border rounded p-3 mb-3" data-id="${materiCount}">
                        <h5>Materi ${materiCount} - Gambar</h5>
                        <input type="hidden" name="materi[${materiCount}][type]" value="image">
                        <div class="mb-3">
                            <label for="title_${materiCount}" class="form-label">Judul Materi</label>
                            <input type="text" name="materi[${materiCount}][title]" id="title_${materiCount}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_${materiCount}" class="form-label">Pilih Gambar</label>
                            <input type="file" name="materi[${materiCount}][image]" id="image_${materiCount}" class="form-control" accept="image/*" required>
                        </div>
                        <button type="button" class="btn btn-danger remove-materi" data-id="${materiCount}">Hapus</button>
                    </div>`;
            } else if (type === 'video') {
                contentHTML = `
                    <div class="materi-item border rounded p-3 mb-3" data-id="${materiCount}">
                        <h5>Materi ${materiCount} - Video</h5>
                        <input type="hidden" name="materi[${materiCount}][type]" value="video">
                        <div class="mb-3">
                            <label for="title_${materiCount}" class="form-label">Judul Materi</label>
                            <input type="text" name="materi[${materiCount}][title]" id="title_${materiCount}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="video_${materiCount}" class="form-label">Pilih Video</label>
                            <input type="file" name="materi[${materiCount}][video]" id="video_${materiCount}" class="form-control" accept="video/*" required>
                        </div>
                        <button type="button" class="btn btn-danger remove-materi" data-id="${materiCount}">Hapus</button>
                    </div>`;
            }

            document.getElementById('materiList').insertAdjacentHTML('beforeend', contentHTML);
        }

        // Tambah Materi Teks
        document.getElementById('addTextContent').addEventListener('click', function() {
            addContent('text');
        });

        // Tambah Materi Gambar
        document.getElementById('addImageContent').addEventListener('click', function() {
            addContent('image');
        });

        // Tambah Materi Video
        document.getElementById('addVideoContent').addEventListener('click', function() {
            addContent('video');
        });

        // Hapus Materi
        document.getElementById('materiList').addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-materi')) {
                const materiId = event.target.getAttribute('data-id');
                const materiItem = document.querySelector(`.materi-item[data-id="${materiId}"]`);
                if (materiItem) materiItem.remove();
            }
        });
    });
</script>
@endpush
