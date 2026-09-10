<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GITA OCTAVIA')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { background-color: #fff0f5; }
        
        /* Navbar Gelembung */
        .navbar { margin-top: 20px; border-radius: 50px; background: white; box-shadow: 0 4px 15px rgba(255, 182, 193, 0.3); padding: 10px 20px; }
        .navbar-brand { font-weight: bold; }
        .navbar-nav .nav-link { border-radius: 50px; padding: 8px 20px; font-weight: 500; color: #555; transition: 0.3s; }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: white; background-color: #d63384; }
        
        /* Tombol Auth */
        .btn-login { border-radius: 50px; border: 2px solid #d63384; color: #d63384; font-weight: 500; padding: 8px 20px; transition: 0.3s; }
        .btn-login:hover { background-color: #d63384; color: white; }
        .btn-register { border-radius: 50px; background-color: #d63384; color: white; font-weight: 500; padding: 8px 20px; transition: 0.3s; }
        .btn-register:hover { background-color: #b02a6b; }

        /* Fitur & Grafik */
        .feature-card { transition: 0.3s; border: none; border-radius: 20px; box-shadow: 0 4px 20px rgba(214, 51, 132, 0.1); height: 100%; text-decoration: none; color: inherit; background: white; }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 8px 30px rgba(214, 51, 132, 0.2); color: inherit; }
        .icon-circle { width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #d63384; background-color: #fce4ec; margin: 0 auto 15px auto; }
        .text-pink { color: #d63384; }

        /* Hero Pink */
        .hero-section { background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); color: white; border-radius: 30px; padding: 60px 0; text-align: center; margin-top: 40px; margin-bottom: 50px; }
    </style>
</head>
<body>
    <!-- NAVBAR GELEMBUNG -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="bi bi-shop"></i> GITA<span class="text-pink">OCTAVIA</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <!-- Tandai menu yang aktif -->
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('pos.index') ? 'active' : '' }}" href="{{ route('pos.index') }}">POS</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('produk.index') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Laporan</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('pelanggan.index') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                    </ul>

                    <!-- LOGIN/REGISTER/LOGOUT DINAMIS -->
                    <div class="d-flex gap-2 align-items-center">
                        @auth
                            <span class="fw-bold text-pink me-2"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-register">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-register">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- KONTEN HALAMAN -->
    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>