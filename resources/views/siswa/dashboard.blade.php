@extends('siswa.layout.navbar')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(to bottom, #6a11cb, #2575fc);
            color: white;
            text-align: center;
            padding: 50px 0;
            border-radius: 10px;
        }

        /* Title Kategori */
        .category-title {
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 1.8rem;
            color: #6a11cb;
            text-transform: uppercase;
            text-align: center;
        }

        /* Container Kategori */
        .category-container {
            margin-bottom: 50px;
            padding: 20px;
            background-color: #f7f9fc;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Card Modul */
        .module-card {
            transition: all 0.3s ease-in-out;
            border: 2px solid transparent;
            border-radius: 10px;
        }

        .module-card:hover {
            transform: translateY(-5px);
            border-color: #6a11cb;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Gambar Modul */
        .module-card img {
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        /* Tombol Modul */
        .module-card .btn-primary {
            background-color: #6a11cb;
            border-color: #6a11cb;
            transition: all 0.3s ease-in-out;
        }

        .module-card .btn-primary:hover {
            background-color: #2575fc;
            border-color: #2575fc;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Banner -->
    <div class="hero-banner">
        <div class="container">
            <h1>Halo, {{ $username }}!</h1>
            <p>Temukan berbagai modul dan kategori pembelajaran yang menarik.</p>
        </div>
    </div>

    <!-- Kontainer Modul -->
    <div class="container mt-5">
        @foreach ($categories as $category)
            <div class="category-container">
                <!-- Nama Kategori -->
                <h2 class="category-title">{{ $category->name }}</h2>

                <div class="row">
                    @foreach ($category->modules->take(3) as $module)
                        <div class="col-md-4">
                            <div class="card module-card">
                                <img src="{{ asset($module->image) }}" class="card-img-top" alt="{{ $module->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $module->title }}</h5>
                                    <p class="card-text">{{ $module->description }}</p>

                                    <!-- Ambil materi pertama dari modul -->
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
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <!-- Tambahkan script jika dibutuhkan -->
@endpush
