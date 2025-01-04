@extends('siswa.layout.navbar')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        .materi-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px 15px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
        }

        .materi-title {
            font-size: 2rem;
            font-weight: bold;
            color: #0056b3;
            text-align: center;
            margin-bottom: 20px;
        }

        .materi-image {
            max-width: 100%;
            max-height: 400px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .image-caption {
            font-size: 0.9rem;
            color: #555;
            text-align: center;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        .materi-content {
            font-size: 1.15rem;
            line-height: 1.8;
            text-align: justify;
            color: #333;
        }

        .materi-content p {
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
<div class="container mt-5">
    @php
        $mergedMateris = [];
        for ($i = 0; $i < count($orderedMateris); $i++) {
            $currentMateri = $orderedMateris[$i];
            $nextMateri = $orderedMateris[$i + 1] ?? null;

            if ($currentMateri->content && $nextMateri && $nextMateri->image) {
                $mergedMateris[] = [
                    'title' => $currentMateri->title,
                    'content' => $currentMateri->content,
                    'image' => $nextMateri->image,
                    'image_caption' => $nextMateri->title
                ];
                $i++;
            } else {
                $mergedMateris[] = $currentMateri;
            }
        }
    @endphp

    @foreach ($mergedMateris as $materi)
    <div class="materi-container" data-aos="fade-up">
        <!-- Judul Materi -->
        <h1 class="materi-title" data-aos="fade-down">{{ $materi['title'] ?? $materi->title }}</h1>

        <!-- Konten Materi -->
        @if (isset($materi['content']) || isset($materi->content))
            <div class="materi-content" data-aos="fade-up">
                @php
                    $content = isset($materi['content']) ? $materi['content'] : $materi->content;
                    $paragraphs = explode("\n", $content);
                @endphp
                @foreach ($paragraphs as $paragraph)
                    @if (trim($paragraph) !== '')
                        <p>{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>
        @endif

        <!-- Gambar (jika ada) -->
        @if (isset($materi['image']) || isset($materi->image))
            <div class="text-center" data-aos="zoom-in">
                <img
                    src="{{ asset('storage/' . ($materi['image'] ?? $materi->image)) }}"
                    alt="{{ $materi['title'] ?? $materi->title }}"
                    class="materi-image">
                <p class="image-caption">{{ $materi['image_caption'] ?? '' }}</p>
            </div>
        @endif

        <!-- Video (jika ada) -->
        @if (isset($materi['video']) || isset($materi->video))
        <div class="text-center" data-aos="zoom-in">
            <video controls preload="metadata" class="materi-video" width="640" height="360">
                <source src="{{ asset('storage/' . ($materi['video'] ?? $materi->video)) }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
            <p class="video-caption">{{ $materi['video_caption'] ?? '' }}</p>
        </div>
        @endif

    </div>
    @endforeach


</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 1000, // Durasi animasi (ms)
                once: true, // Animasi hanya terjadi sekali
            });
        });
    </script>
@endpush
