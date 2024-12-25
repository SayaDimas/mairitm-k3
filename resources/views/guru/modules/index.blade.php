@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modul Pembelajaran</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Daftar Modul</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Judul Modul</th>
                <th>Deskripsi</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modules as $module)
                <tr>
                    <td>{{ $module->title }}</td>
                    <td>{{ $module->description }}</td>
                    <td>{{ $module->created_at->format('d M Y') }}</td>
                    <td>
                        <!-- Tombol Edit Modul -->
                        <a href="{{ route('guru.modules.edit', $module->id) }}" class="btn btn-warning btn-xs">
                            Edit Modul
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
