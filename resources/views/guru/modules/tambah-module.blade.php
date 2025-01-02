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
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori Modul</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Modul</button>
    </form>
</div>
@endsection
