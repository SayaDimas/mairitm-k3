<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row flex-nowrap">
                <!-- Side Menu -->
                @auth
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Menu</span>
                        </a>

                        @if (Auth::user()->role === 'admin')
                            <button class="btn btn-dark w-100 text-start mb-2" onclick="location.href='{{ route('admin.dashboard') }}'">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Admin Dashboard</span>
                            </button>
                            <button class="btn btn-dark w-100 text-start mb-2" onclick="location.href=''">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Manage Users</span>
                            </button>
                        @elseif (Auth::user()->role === 'guru')
                            <button class="btn btn-dark w-100 text-start mb-2" onclick="location.href='{{ route('guru.dashboard') }}'">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Guru Dashboard</span>
                            </button>
                            <button class="btn btn-dark w-100 text-start mb-2" onclick="location.href='{{ route('guru.modules.index') }}'">
                                <i class="fs-4 bi-journal"></i> <span class="ms-1 d-none d-sm-inline">Manage Lessons</span>
                            </button>
                            <button class="btn btn-dark w-100 text-start mb-2" onclick="location.href='{{ route('guru.modules.create') }}'">
                                <i class="fs-4 bi-journal"></i> <span class="ms-1 d-none d-sm-inline">Tambah Modules</span>
                            </button>
                        @elseif (Auth::user()->role === 'siswa')
                            <button class="btn btn-dark w-100 text-start mb-2" onclick="location.href='/siswa/dashboard'">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Student Dashboard</span>
                            </button>
                            <button class="btn btn-dark w-100 text-start mb-2" onclick="location.href='/siswa/courses'">
                                <i class="fs-4 bi-book"></i> <span class="ms-1 d-none d-sm-inline">My Courses</span>
                            </button>
                        @else
                            <button class="btn btn-dark w-100 text-start mb-2" onclick="location.href='/dashboard'">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </button>
                        @endif
                    </div>
                </div>
                @endauth

                <!-- Content -->
                <div class="col py-3">
                    @yield('content')
                </div>
            </div>
        </div>

        @stack('scripts')
    </div>
</body>
</html>
