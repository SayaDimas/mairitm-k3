{{-- @if (Auth::user()->role == 'admin')
    <h1>Selamat datang, Admin!</h1>
@elseif (Auth::user()->role == 'guru')
    <h1>Selamat datang, Guru!</h1>
@elseif (Auth::user()->role == 'siswa')
    <h1>Selamat datang, Siswa!</h1>
@endif --}}

@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Dashboard Guru</h1>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Daftar Siswa -->
    <h2>Daftar Siswa</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>


                        <!-- Hapus Siswa -->
                        <form action="{{ route('guru.deleteStudent', $student->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
