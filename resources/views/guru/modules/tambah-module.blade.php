@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Modul Baru</h2>
    <form action="{{ route('guru.modules.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Modul</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Modul</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Modul</button>
    </form>
</div>
@endsection
