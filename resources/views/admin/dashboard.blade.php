
{{-- @extends('layouts.app')

@if (Auth::user()->role == 'admin')
    <h1>Selamat datang, Admin!</h1>
@elseif (Auth::user()->role == 'guru')
    <h1>Selamat datang, Guru!</h1>
@elseif (Auth::user()->role == 'siswa')
    <h1>Selamat datang, Siswa!</h1>
@endif --}}

@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Daftar Pengguna -->
    <h2>Daftar Pengguna</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <!-- Form Ubah Role -->
                        <form action="{{ route('admin.updateRole', $user->id) }}" method="POST">
                            @csrf
                            <select name="role" class="form-select" onchange="this.form.submit()">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tambah Admin Baru -->

</div>
@endsection
