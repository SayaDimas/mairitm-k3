@extends('siswa.layout.navbar')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .materi-container {
            text-align: center;
            padding: 50px 20px;
        }

        .materi-image {
            max-width: 100%;
            max-height: 400px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .materi-content {
            font-size: 1.2rem;
            text-align: justify;
            margin-bottom: 100px;
            color: #333;
        }

        .navigation-buttons {
            position: fixed;
            bottom: 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }

        .btn-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #007bff;
            color: white;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-icon:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }
    </style>
@endpush

@section('content')
<div class="container mt-5">
    <!-- Tampilkan materi -->
    @foreach ($orderedMateris as $materi)
        <div class="materi-item mb-5">
            <!-- Judul Materi -->
            <h2 class="text-primary"> {{ $materi->title }}</h2>

            <!-- Gambar (jika ada) -->
            @if ($materi->image)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' .$materi->image) }}"alt="{{ $materi->title }}" class="materi-image">
                </div>
            @endif

            <!-- Isi Materi -->
            <div class="materi-content">
                <p>{{ $materi->content }}</p>
            </div>

            <!-- Navigasi Materi -->

        </div>
        <hr>
    @endforeach
</div>

{{--
<!-- Navigasi -->
<div class="navigation-buttons">
    <!-- Tombol Back -->
    <a href="{{ $previousUrl ?? url('/siswa/home') }}" class="btn-icon" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- Tombol Next -->
    @if ($nextUrl)
        <a href="{{ $nextUrl }}" class="btn-icon" title="Materi Selanjutnya">
            <i class="bi bi-arrow-right"></i>
        </a>
    @endif
</div> --}}
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
@endpush
