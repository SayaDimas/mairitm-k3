@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Modul</h1>

    <form action="{{ route('guru.modules.update', $module->id) }}" method="POST">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="title" class="form-label">Judul Modul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $module->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Modul</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $module->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Modul</button>
    </form>

    <hr>

    {{-- <h3>Materi</h3>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form untuk menambah materi -->
    <form action="{{ route('guru.modules.add_materi', $module->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="materi_ke" class="form-label">Materi Ke-</label>
            <input type="number" name="materi_ke" id="materi_ke" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Judul Materi</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Isi Materi</label>
            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar (opsional)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Video (opsional)</label>
            <input type="file" name="video" id="video" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Tambah Materi</button>
    </form>

    <hr> --}}


    <a href="{{ route('guru.modules.add_materi', $module->id) }}" class="btn btn-warning btn-xs">
        tambah materi
    </a>
    <h4>Daftar Materi</h4>
<ul class="list-group">
    @foreach ($materi as $item)
        <li class="list-group-item">
            <strong>Materi {{ $item->materi_ke }}:</strong> {{ $item->title }}

            @if ($item->image)
                <br><img src="{{ asset('storage/' . $item->image) }}" alt="Gambar" width="100">
            @endif

            @if ($item->video)
                <br><video width="200" controls>
                    <source src="{{ asset('storage/' . $item->video) }}" type="video/mp4">
                </video>
            @endif

            <!-- Delete Button -->
            <form action="{{ route('guru.modules.destroy_materi', $item->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </li>
    @endforeach
</ul>

</div>
@endsection
