@if (Auth::user()->role == 'admin')
    <h1>Selamat datang, Admin!</h1>
@elseif (Auth::user()->role == 'guru')
    <h1>Selamat datang, Guru!</h1>
@elseif (Auth::user()->role == 'siswa')
    <h1>Selamat datang, Siswa!</h1>
@endif
