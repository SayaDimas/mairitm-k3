@extends('siswa.layout.navbar')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet"> <!-- AOS CSS -->
    <style>
        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(to bottom, #025fff, #25c3fc), url("{{ asset('img/uderwater.png') }}");
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
    <div class="hero-banner" data-aos="fade-up" data-aos-duration="1000">
        <div class="container text-center">
            <h1>Halo, {{ $username }}!</h1>
            <p>Selamat datang di platform pembelajaran kami! Temukan berbagai modul dan materi yang akan membantu Anda dalam mengetahui cara bertahan hidup. you happy i am happy, i am happy everybody will be happy!</p>
        </div>
    </div>

    <!-- Kontainer Modul -->
    <div class="container mt-5">
        @foreach ($categories as $category)
            <div class="category-container" data-aos="fade-up" data-aos-duration="1000">
                <!-- Nama Kategori -->
                <h2 class="category-title">{{ $category->name }}</h2>

                <div class="row">
                    @foreach ($category->modules->take(3) as $module)
                        <div class="col-md-4" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="card module-card">
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
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script> <!-- AOS JS -->
    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 1000, // Durasi animasi dalam ms
            once: true, // Animasi hanya terjadi sekali saat scroll
        });
    </script>
@endpush
