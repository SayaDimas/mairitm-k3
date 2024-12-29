@extends('siswa.layout.navbar')

@section('content')
<div class="container mt-4">
    <!-- Nama Kategori -->
    <h1 class="mb-4 text-center">{{ $category->name }}</h1>

    <!-- Modul-Modul -->
    <div class="row">
        @forelse ($modules as $module) {{-- gunakan $category->moduls --}}
            <!-- Card Modul -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $module->title }}</h5>
                        <p class="card-text">{{ $module->description }}</p>
                        @php
                                        $firstMateri = $module->materis->first();
                                    @endphp

                                    <!-- Tombol buka modul, mengarah ke materi pertama dalam modul -->
                                    @if ($firstMateri)
                                        <a href="{{ route('materi.show', ['module_id' => $module->id, 'materi_id' => $firstMateri->id]) }}" class="btn btn-primary">Buka Modul</a>
                                    @else
                                        <p>Tidak ada materi dalam modul ini.</p>
                                    @endif

                    </div>
                </div>
            </div>
        @empty
            <!-- Jika tidak ada modul -->
            <div class="col-12">
                <p class="text-muted text-center">Tidak ada modul untuk kategori ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
